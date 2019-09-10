<?php
namespace Celebros\SearchApi\Api;
class QwiserProduct
{
    var $field;
    var $foundInAnswerId;
    var $foundInAnswerPath;
    var $isBestSeller;
    var $matchClassFound;
    var $price;
    var $sku;
        
    public function __construct(\DOMElement $prodNode)
    {
        $this->field = $this->_getProductCommonInformation($prodNode);
        $this->foundInAnswerId = $prodNode->getAttribute("FoundInAnswerId");
        $this->foundInAnswerPath = $prodNode->getAttribute("FoundInAnswerPath");
        $this->isBestSeller = $prodNode->getAttribute("IsBestSeller");
        $this->matchClassFound = $prodNode->getAttribute("MatchClassFound");
        $this->price = $prodNode->getAttribute("Price");
        $this->sku = $prodNode->getAttribute("Sku");
    }   
        
    protected function _getProductCommonInformation(\DOMElement $prodNode)
    {
        $result = [];
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $helper = $objectManager->get('Celebros\SearchApi\Helper\Data');
        if ($prodNode->hasChildNodes()) {
            $productFields = $prodNode->childNodes;
            foreach ($productFields as $productField) {
                if ($productField->hasChildNodes()) {
                    foreach ($productField->childNodes as $field) {
                        if ($field->nodeType == 1) {
                            $result[strtolower($field->getAttribute("name"))] = $field->getAttribute("value");
                        }
                    }
                }
            }
        }
        
        return $result;
    } 
}
