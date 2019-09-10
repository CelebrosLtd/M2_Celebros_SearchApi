<?php
namespace Celebros\SearchApi;

class SearchApiException extends \Exception {}

class Search extends Base
{
    //Answer Question
    public function AnswerQuestion($searchHandle, $answerId, $effectOnSearchPath)
    {
        $requestUrl = "AnswerQuestion?SearchHandle=" . $searchHandle."&answerId=" . $answerId . "&EffectOnSearchPath=" . $effectOnSearchPath . "&Sitekey=" . $this->siteKey;
        $this->results = $this->GetResult($requestUrl, "QwiserSearchResults");
        return $this;
    }
    
    //Answer Questions
    public function AnswerQuestions($searchHandle, $answerIds, $effectOnSearchPath)
    {
        $requestUrl = "AnswerQuestions?SearchHandle=" . $searchHandle . "&answerIds=" . $answerIds . "&EffectOnSearchPath=" . $effectOnSearchPath . "&Sitekey=" . $this->siteKey;
        $this->results = $this->GetResult($requestUrl, "QwiserSearchResults");
        return $this;
    }   
    
    //Change Number of Products in Page
    public function ChangePageSize($searchHandle, $pageSize)
    {
        $requestUrl = "ChangePageSize?SearchHandle=" . $searchHandle . "&pageSize=" . $pageSize . "&Sitekey=" . $this->siteKey;
        $this->results = $this->GetResult($requestUrl, "QwiserSearchResults");
        return $this;
    }
    
    //Moves to the first page of the results
    public function FirstPage($searchHandle)
    {
        $requestUrl = "FirstPage?SearchHandle=" . $searchHandle . "&Sitekey=" . $this->siteKey;
        $this->results = $this->GetResult($requestUrl, "QwiserSearchResults");
        return $this;
    }
    
    //Get alll the product fields
    public function GetAllProductFields()
    {
        $requestUrl = "GetAllProductFields?Sitekey=" . $this->siteKey;
        $this->results = $this->GetResult($requestUrl, "QwiserProductFields");
        return $this;
    }
    
    //Return all the questions
    public function GetAllQuestions()
    {
        $requestUrl = "GetAllQuestions?Sitekey=" . $this->siteKey;
        $requestUrl .= "&Searchprofile=";
        $this->results = $this->GetResult($requestUrl, "QwiserQuestions");
        return $this;
    }
    
    public function GetAllSearchProfiles()
    {
        $requestUrl = "GetAllSearchProfiles?Sitekey=" . $this->siteKey;
        $this->results = $this->GetResult($requestUrl, "QwiserSimpleStringCollection");
        return $this;
    }
    
    //Gets the results for the specified search handle
    public function GetCustomResults($searchHandle, $bNewSearch, $previousSearchHandle)
    {
        $requestUrl = "GetCustomResults?SearchHandle=" . $searchHandle . "&NewSearch=" . $bNewSearch . "&PreviousSearchHandle=" . $previousSearchHandle . "&Sitekey=" . $this->siteKey;
        $this->results = $this->GetResult($requestUrl, "QwiserSearchResults");
        return $this;
    }
    
    //Gets all the answers that a product exists in
    public function GetProductAnswers($sku)
    {
        $sku = urlencode($sku);
        $requestUrl = "GetProductAnswers?Sku=" . $sku . "&Sitekey=" . $this->siteKey;
        $this->results = $this->GetResult($requestUrl, "QwiserProductAnswers");
        return $this;   
    }    
    
    //Gets the full path to the best answer for this product under the selected question for the �View All� feature (in the SPD).
    public function GetProductSearchPath($sku)
    {
        $sku = urlencode($sku);
        $requestUrl = "GetProductSearchPath?Sku=" . $sku . "&Sitekey=" . $this->siteKey;
        $this->results = $this->GetResult($requestUrl, "QwiserSearchPath");
        return $this;
    }
    
    //Returns the answers for a specific question
    public function GetQuestionAnswers($questionId)
    {
        $requestUrl = "GetQuestionAnswers?QuestionId=" . $questionId . "&Sitekey=" . $this->siteKey;
        $this->results = $this->GetResult($requestUrl, "QwiserAnswers");
        return $this;
    }
    
    //Return the LastPage.
    public function LastPage($searchHandle)
    {
        $requestUrl = "LastPage?SearchHandle=" . $searchHandle . "&Sitekey=" . $this->siteKey;
        $this->results = $this->GetResult($requestUrl, "QwiserSearchResults");
        return $this;
    }
    
    //Moves to the specified page of the results
    public function MoveToPage($searchHandle, $page)
    {
        $requestUrl = "MoveToPage?SearchHandle=" . $searchHandle . "&Page=" . $page . "&Sitekey=" . $this->siteKey;
        $this->results = $this->GetResult($requestUrl, "QwiserSearchResults");
        return $this;
    }
    
    //Moves to the previous page of the results
    public function PreviousPage($searchHandle)
    {
        $requestUrl = "PreviousPage?SearchHandle=" . $searchHandle . "&Sitekey=" . $this->siteKey;
        $this->results = $this->GetResult($requestUrl, "QwiserSearchResults");
        return $this;
    }
    
    //Moves to the next page of the results
    public function NextPage($searchHandle)
    {
        $requestUrl = "NextPage?SearchHandle=" . $searchHandle . "&Sitekey=" . $this->siteKey;
        $this->results = $this->GetResult($requestUrl, "QwiserSearchResults");
        return $this;
    }    
    
    //Gets the results for the specified search term.
    public function Search($query)
    {
        $query = urlencode($query);
        $requestUrl = "search?Query=" . $query . "&sitekey=" . $this->siteKey;
        $this->results = $this->GetResult($requestUrl, "QwiserSearchResults");
        return $this;
    }
    
    //Gets the results for the specified search term under the specified search profile and the answer which Id was specified.
    public function SearchAdvance($query, $searchProfile, $answerId, $effectOnSearchPath, $priceColumn, $pageSize, $sortingfield, $bNumericsort, $bAscending)
    {
        $query = urlencode($query);
        $searchProfile = urlencode($searchProfile);
        $sortingfield = urlencode($sortingfield);
        //$PriceColumn = urlencode($PriceColumn);
        $priceColumn = "";
        $requestUrl = "SearchAdvance?Query=" . $query . "&SearchProfile=" . $searchProfile . "&AnswerId=" . $answerId . "&EffectOnSearchPath=" . $effectOnSearchPath . "&PriceColumn=" .
            $priceColumn . "&PageSize=" . $pageSize . "&Sortingfield=" . $sortingfield . "&Numericsort=" . $bNumericsort . "&Ascending=" . $bAscending . "&sitekey=" . $this->siteKey;
        $this->results = $this->GetResult($requestUrl, "QwiserSearchResults");
        return $this;
    }
    
    //Changes the sorting of the results to display products by the value of the specified field, and whether to perform a numeric sort on that field, in the specified sorting direction.
    public function SortByField($searchHandle, $fieldName, $bNumericSort, $bAscending)
    {
        $fieldName = urlencode($fieldName);
        $requestUrl = "SortByField?SearchHandle=" . $searchHandle . "&FieldName=" . $fieldName . "&NumericSort=" . $bNumericSort . "&Ascending=" . $bAscending . "&sitekey=" . $this->siteKey;
        $this->results = $this->GetResult($requestUrl, "QwiserSearchResults");
        return $this;
    }
    
    //Changes the sorting of the results to display products by their price in the specified sorting direction
    public function SortByPrice($searchHandle, $bAscending)
    {
        $requestUrl = "SortByPrice?SearchHandle=".$searchHandle."&Ascending=".$bAscending."&sitekey=".$this->siteKey;
        $this->results = $this->GetResult($requestUrl, "QwiserSearchResults");
        return $this;
    }
    
    //Changes the sorting of the results to display products by relevancy in descending order.
    public function SortByRelevancy($searchHandle)
    {
        $requestUrl = "SortByRelevancy?SearchHandle=" . $searchHandle . "&Sitekey=" . $this->siteKey;
        $this->results = $this->GetResult($requestUrl, "QwiserSearchResults");
        return $this;
    }
}
