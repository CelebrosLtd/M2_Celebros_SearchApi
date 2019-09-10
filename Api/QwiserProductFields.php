<?php
namespace Celebros\SearchApi\Api;
class QwiserProductFields
{
	var $count = 0;
	var $items = [];
	
	public function __construct(\DOMNodeList $xmlProductFields)
	{
        $index = 0;
        foreach ($xmlProductFields as $fieldsNode) {
            foreach ($fieldsNode->childNodes as $node) {
                if ($node instanceof \DOMElement) {
                    $index++;
                    $this->count++;
                    $this->items[$index] = new \Celebros\SearchApi\Api\QwiserProductField($node);
                }
            }
        }
	}
}
