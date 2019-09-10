<?php
namespace Celebros\SearchApi\Api;
class QwiserProducts
{
	var $count = 0;
	var $items = [];
	
	public function __construct(\DOMNodeList $xmlProducts)
	{
        foreach ($xmlProducts as $productNode) {
            $index = 0;
            foreach ($productNode->childNodes as $node) {
                if ($node instanceof \DOMElement) {
                    $index++;
                    $this->count++;
                    $this->items[$index] = new \Celebros\SearchApi\Api\QwiserProduct($node);
                }
            }            
        }
	}
}
