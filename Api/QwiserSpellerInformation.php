<?php
namespace Celebros\SearchApi\Api;
class QwiserSpellerInformation 
{
	public $additionalSuggestions = [];
	public $spellerAutoCorrection;
	public $spellingErrorDetected = "false";
	
	public function __construct(\DOMNodeList $xmlSpellerInformation)
	{		
		$xmlSpellerInformation = $xmlSpellerInformation->item(0);
        $this->spellingErrorDetected = $xmlSpellerInformation->getAttribute("SpellingErrorDetected");
		$this->spellerAutoCorrection = $xmlSpellerInformation->getAttribute("SpellerAutoCorrection");
        
        if ($xmlSpellerInformation->hasChildNodes()) {
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $helper = $objectManager->get('Celebros\SearchApi\Helper\Data');
            $this->additionalSuggestions = $helper->getQwiserSimpleStringCollection($xmlSpellerInformation->childNodes);
        }
    }
}
