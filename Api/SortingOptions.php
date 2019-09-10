<?php
namespace Celebros\SearchApi\Api;
class SortingOptions
{
    var $ascending;
    var $fieldName;
    var $numericSort;
    var $method;
    
    public function __construct(\DOMNodeList $xmlSortingOptions)
    {
        $xmlSortingOptions = $xmlSortingOptions->item(0);
        $this->ascending = $xmlSortingOptions->getAttribute("Ascending");
        $this->fieldName = $xmlSortingOptions->getAttribute("FieldName");
        $this->numericSort = $xmlSortingOptions->getAttribute("NumericSort");
        $this->method = $xmlSortingOptions->getAttribute("Method");
    }
    
    public function toString()
    {
        $builder = "";
        if($this->ascending == "true") $builder .= "1";
        else $builder .= "0";
        $builder .= "^";
        if($this->numericSort == "true") $builder .= "1";
        else $builder .= "0";
        $builder .= "^";
        $builder .= $this->_sortMethodToInt($this->method);
        $builder .= "^";
        $builder .= $this->fieldName;
        
        return $builder;
    }
    
    
    public function isDefault()
    {
        return (($this->ascending != "true" && $this->numericSort != "true") && ((strlen($this->fieldName) == 0) && ($this->method == "Relevancy")));
    }

    private function _sortMethodToInt($strSortMethod) : int
    {
        switch ($strSortMethod) {
            case "Price":
                return 0;
                break;
            case "Relevancy":
                return 1;
                break;
            case "SpecifiedField":
                return 2;
                break;
        }
    }
}
