<?php
namespace Celebros\SearchApi\Api;
class SearchInformation
{
    public $query;
    public $originalQuery;
    public $searchProfileName;
    public $priceFieldName;
    public $numberOfPages; 
    public $currentPage;
    public $pageSize;
    public $isDefaultPageSize;
    public $isDefaultSearchProfileName;
    public $skuSearchOccured;
    public $deadEndOccurred;
    public $firstQuestionId;
    public $sessionId;
    public $stage;
    public $sortingOptions;
    public $answeredAnswers;
    public $specialCasesDetectedInThisSession;
    public $minMatchClassFound= 0;
    public $maxMatchClassFound = 5;

    public function __construct(\DOMNodeList $xmlSearchInformation)
    {
        $xmlSearchInformation = $xmlSearchInformation->item(0);
        $this->query = $xmlSearchInformation->getAttribute("Query");
        $this->originalQuery = $xmlSearchInformation->getAttribute("OriginalQuery");
        $this->searchProfileName = $xmlSearchInformation->getAttribute("SearchProfileName");
        $this->priceFieldName = $xmlSearchInformation->getAttribute("PriceFieldName");
        $this->numberOfPages = $xmlSearchInformation->getAttribute("NumberOfPages");
        $this->currentPage = $xmlSearchInformation->getAttribute("CurrentPage");
        $this->pageSize = $xmlSearchInformation->getAttribute("PageSize");
        $this->isDefaultPageSize = $xmlSearchInformation->getAttribute("IsDefaultPageSize");
        $this->skuSearchOccured = $xmlSearchInformation->getAttribute("SkuSearchOccured");
        $this->deadEndOccurred = $xmlSearchInformation->getAttribute("DeadEndOccurred");
        $this->firstQuestionId = $xmlSearchInformation->getAttribute("FirstQuestionId");
        $this->sessionId = $xmlSearchInformation->getAttribute("SessionId");
        $this->stage = $xmlSearchInformation->getAttribute("Stage");
        $this->sortingOptions = new \Celebros\SearchApi\Api\SortingOptions($xmlSearchInformation->getElementsByTagName("SortingOptions"));
        $this->answeredAnswers = new \Celebros\SearchApi\Api\QwiserAnsweredAnswers($xmlSearchInformation->getElementsByTagName("AnsweredAnswers"));
        $this->specialCasesDetectedInThisSession = new \Celebros\SearchApi\Api\SpecialCasesDetectedInThisSession($xmlSearchInformation->getElementsByTagName("SpecialCasesDetectedInThisSession"));
    }
    
    public function toSearchHandle($builder = '')
    {
        if (strlen($this->query) > 0) {
            $builder .= "A=" . str_replace("~", "~~", $this->query) . "~";
        }
        
        if (strlen($this->originalQuery) > 0) {
            $builder .= "B=" . str_replace("~", "~~", $this->originalQuery) . "~";
        }
        
        if ($this->currentPage != "0") {
            $builder .= "C=" . $this->currentPage . "~";
        }
         
        if ($this->isDefaultPageSize != "true") {
            $builder .= "D=" . $this->pageSize . "~";
        }

        if (isset($this->sortingOptions) && !$this->sortingOptions->isDefault()) {
            $builder .= "E=" . str_replace("~", "~~", $this->sortingOptions->toString()) . "~";
        }
        
        if (strlen($this->firstQuestionId) > 0) {
            $builder .= "F=" . str_replace("~", "~~", $this->firstQuestionId) . "~";
        }

        if ($this->answeredAnswers->count > 0) {
            $builder .= "G=" .  str_replace("~", "~~", $this->answeredAnswersToString()) . "~";
        }       

        if ($this->isDefaultSearchProfileName != "true") {
            $builder .= "H=" . str_replace("~", "~~",  $this->searchProfileName) . "~";
        }
        
        if (strlen($this->priceFieldName) > 0) {
            $builder .= "I=" . str_replace("~", "~~",  $this->priceFieldName) . "~";
        }

        if (isset($this->specialCasesDetectedInThisSession) && $this->specialCasesDetectedInThisSession->count > 0) {
            $builder .= "J=" . str_replace("~", "~~", $this->specialCasesDetectedInThisSessionToString());
        }
        
        if ($this->maxMatchClassFound != 0) {
            $builder .= "K=" . $this->maxMatchClassFound . "~";
        }
 
        if ($this->minMatchClassFound != 0) {
            $builder .= "L=" . $this->minMatchClassFound . "~";
        }
        
        if (!$this->isDefaultNumberOfPages()) {
            $builder .= "M=" . $this->numberOfPages . "~";
        }
        
        if (!$this->isDefaultStage()) {
            $builder .= "N=" . $this->stage . "~";
        }

        return $builder;
    }
    
    private function answeredAnswersToString()
    {
        return $this->answeredAnswers->toSimpleString();
    }
    
    private function specialCasesDetectedInThisSessionToString()
    {
        return $this->specialCasesDetectedInThisSession->toSimpleString();
    }
    
    private function isDefaultNumberOfPages()
    {
        return $this->numberOfPages == "1";
    }
    
    private function isDefaultStage()
    {
        return $this->stage == "1";
    }
}
