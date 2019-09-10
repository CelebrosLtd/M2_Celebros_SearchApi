<?php
namespace Celebros\SearchApi;

/*class SearchApiException extends \Exception {}*/

class Base
{
    const CURL_CONNECTTIMEOUT = 600; /* in ms */
    const CURL_TIMEOUT = 400; /* in ms */
    const CURL_RETRY_DELAY = 1; /* in s */
    
    protected $_curl;
    
    public $communicationPort; //The name of the comm port to use for access to the search server.
    public $hostName;  //The name of the search server to connect to.
    public $siteKey;   //the api site key.
    public $lastOperationErrorMessage; //the last operation error message.
    public $lastOperationSucceeded; //return true if the last operation ended successfully.
    public $webService;    //Search WebService full uri. 

    protected $init = false;
    
    public function __construct(
        \Magento\Framework\HTTP\Client\Curl $curl,
        \Magento\Framework\Xml\Parser $xmlParser,
        \Celebros\SearchApi\Helper\Data $helper
    ) {
        $this->_curl = $curl;
        $this->_curl->setOption(CURLOPT_CONNECTTIMEOUT, self::CURL_CONNECTTIMEOUT);
        $this->_curl->setOption(CURLOPT_TIMEOUT, self::CURL_TIMEOUT);
        $this->_curl->setOption(CURLOPT_RETURNTRANSFER, true);
        $this->_curl->setOption(CURLOPT_BINARYTRANSFER, true);
        $this->_xml = $xmlParser;
        $this->helper = $helper;
    }
    
    public function init($hostName, $siteKey, $communicationPort = 6035, $secure = false)
    {
        $protocol = $secure ? "https" : "http";
        $this->hostName = $hostName;
        $this->siteKey = $siteKey;
        $this->communicationPort = $communicationPort;
        $this->webService = $protocol . "://" . $this->hostName . ":" . $this->communicationPort . "/";
        $this->lastOperationSucceeded = true;
        $this->init = true;
        
        return $this;
    }
    
    public function getCurl()
    {
        return $this->_curl;
    }
    
    public function GetResult($requestUrl, $returnValue)
    {
        $xml_file = $this->getData($this->webService . $requestUrl);
        if (!$xml_file) {
            $this->lastOperationSucceeded = false;
            $this->lastOperationErrorMessage = "Error : could not GET XML input, there might be a problem with the connection";
            return;
        }
        
        $this->_xml->loadXml($xml_file);

        return $this->GetReturnValue($this->_xml, $returnValue);
    }
    
    public function getData($url)
    {
        $data = null;
        try {
            $this->_curl->get($url);
            $data = $this->_curl->getBody();     
        } catch (Exception $e) {
            Mage::logException($e);
        }
        
        return $data;
    }
    
    function GetReturnValue($xml_root, $returnValue)
    {
        switch ($returnValue)
        {
            case "QwiserSearchResults":
                return new \Celebros\SearchApi\Api\QwiserSearchResults($xml_root);
                break;
            case "String":
                return $this->helper->SimpleStringParser($xml_root);
                break;
            case "QwiserQuestions":
                return new \Celebros\SearchApi\Api\QwiserQuestions($xml_root->getDom()->getElementsByTagName("Questions"));
                break;
            case "QwiserProductAnswers":
                return new \Celebros\SearchApi\Api\QwiserProductAnswers($xml_root->getDom()->getElementsByTagName("ProductAnswers"));
                break;
            case "QwiserProductFields":
                return new \Celebros\SearchApi\Api\QwiserProductFields($xml_root->getDom()->getElementsByTagName("ProductFields"));
                break;
            case "QwiserSearchPath":
                return new \Celebros\SearchApi\Api\QwiserSearchPath($xml_root->getDom()->getElementsByTagName("SearchPath"));
                break;
            case "QwiserAnswers":
                return new \Celebros\SearchApi\Api\QwiserAnswers($xml_root->getDom()->getElementsByTagName("Answers"));
                break;
            case "QwiserSimpleStringCollection":
                return $this->helper->getQwiserSimpleStringCollection($xml_root->getDom()->getElementsByTagName("QwiserSimpleStringCollection"));
                break;
        }
    }
}