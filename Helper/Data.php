<?php
namespace Celebros\SearchApi\Helper;
class Data
{
    public function getQwiserSimpleStringCollection(\DOMNodeList $xmlNode)
    {
        $result = [];
        if ($xmlNode->item(0)->hasChildNodes()) {
            foreach ($xmlNode->item(0)->childNodes as $node) {
                if ($node instanceof \DOMElement) {
                    $result[] = $node->textContent;
                }
            }
        } 
        
        return $result;
    }

    public function getQwiserSimpleStringDictionary($xmlNode)
    {
        $xmlNode = ($xmlNode instanceof \DOMNodeList) ? $xmlNode->item(0) : $xmlNode;
        $arr = [];
        if ($xmlNode->hasChildNodes()) {
            foreach ($xmlNode->childNodes as $node) {
                if ($node->nodeType == 1) {
                    
                    $arr[$node->getAttribute("name")] = $node->getAttribute("value");
                }
            }
        }
        
        return $arr;
    }

    public function getDomElements($elements)
    {
        $index = 0;
        $new_element = [];
        foreach ($elements as $value) {
            if ($value->nodeType == 1) {
                $new_element[$index] = $value;
                $index++;
            }
        }
        
        return $new_element;
    }
    
    public function SimpleStringParser($xmlRoot)
    {
        $stringValue = $xmlRoot->getDom()->getElementsByTagName("ReturnValue");
//print_r($stringValue->item(0)->textContent);die;       
        return $stringValue->item(0);
    }
}