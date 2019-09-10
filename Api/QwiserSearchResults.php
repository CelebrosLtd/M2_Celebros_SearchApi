<?php
namespace Celebros\SearchApi\Api;
class QwiserSearchResults
{
	public $xmlRoot;
	public $qwiserSearchResults;
	public $qwiserErrorOccurred;
	public $qwiserErrorMessage;
	public $searchInformation;
	public $questions;
	public $searchPath;
	public $products;
	public $queryConcepts;
	public $spellerInformation;
	public $relatedSearches;
	public $specialCasesDetectedInThisSearch;
	
	public function __construct($root)
	{
		$this->xmlRoot = $root;
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $helper = $objectManager->get('Celebros\SearchApi\Helper\Data');
		$this->qwiserSearchResults = $root->getDom()->getElementsByTagName("QwiserSearchResults")->item(0);
		$this->qwiserErrorOccurred = $root->getDom()->getElementsByTagName("QwiserSearchFacadeWrapper")->item(0)->getAttribute("ErrorOccurred");
		$this->qwiserErrorMessage = $root->getDom()->getElementsByTagName("QwiserError")->item(0);
		$this->searchInformation = new \Celebros\SearchApi\Api\SearchInformation($root->getDom()->getElementsByTagName("SearchInformation"));
		$this->questions = new \Celebros\SearchApi\Api\QwiserQuestions($root->getDom()->getElementsByTagName("Questions"));
		$this->searchPath = new \Celebros\SearchApi\Api\QwiserSearchPath($root->getDom()->getElementsByTagName("SearchPath"));
		$this->products = new \Celebros\SearchApi\Api\QwiserProducts($root->getDom()->getElementsByTagName("Products"));
		$this->queryConcepts = new \Celebros\SearchApi\Api\QwiserConcepts($root->getDom()->getElementsByTagName("QueryConcepts"));
		$this->spellerInformation = new \Celebros\SearchApi\Api\QwiserSpellerInformation($root->getDom()->getElementsByTagName("SpellerInformation"));
		$this->relatedSearches  = $helper->getQwiserSimpleStringCollection($root->getDom()->getElementsByTagName("RelatedSearches"));
		$this->specialCasesDetectedInThisSearch = $root->getDom()->getElementsByTagName("SpecialCasesDetectedInThisSearch")->item(0);
	}
	
	public function getErrorOccurred(){
		return $this->QwiserErrorOccurred;
	}
	
	public function getErrorMessage(){
		if ($this->getErrorOccurred()){
			return $this->qwiserErrorMessage->getAttribute("ErrorMessage");
		}
	}
	
	public function getExactMatchFound()
	{
		return $this->qwiserSearchResults->getAttribute("ExactMatchFound");
	}
	
	public function getLogHandle()
	{
		return $this->qwiserSearchResults->getAttribute("LogHandle");
	}
	
	public function getSearchHandle()
	{
		return $this->qwiserSearchResults->getAttribute("SearchHandle");
	}
	
	public function getMaxMatchClassFound()
	{
		return $this->qwiserSearchResults->getAttribute("MaxMatchClassFound");
	}
	
	public function getMinMatchClassFound()
	{
		return $this->qwiserSearchResults->getAttribute("MinMatchClassFound");
	}	
	
	public function getRecommendedMessage()
	{
		return $this->qwiserSearchResults->getAttribute("RecommendedMessage");
	}
	
	public function getRedirectionUrl()
	{
		return $this->qwiserSearchResults->getAttribute("RedirectionUrl");
	}
	
	public function getRelevantProductsCount()
	{
		return $this->qwiserSearchResults->getAttribute("RelevantProductsCount");
	}
	
	public function getSearchDataVersion()
	{
		return $this->qwiserSearchResults->getAttribute("SearchDataVersion");
	}
	
	public function getSearchEngineTimeDuration()
	{
		return $this->qwiserSearchResults->getAttribute("SearchEngineTimeDuration");
	}
	
	public function getSearchTimeDuration()
	{
		return $this->qwiserSearchResults->getAttribute("SearchTimeDuration");
	}
	
	public function getSearchStatus()
	{
		return $this->qwiserSearchResults->getAttribute("SearchStatus");
	}
}
