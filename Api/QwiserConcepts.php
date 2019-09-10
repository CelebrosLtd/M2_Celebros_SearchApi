<?php
namespace Celebros\SearchApi\Api;
class QwiserConcepts
{
	var $count = 0;
	var $items = [];
	
	public function __construct(\DOMNodeList $xmlConcepts)
	{
        $index = 0;
        foreach ($xmlConcepts as $conceptsNode) {
            foreach ($conceptsNode->childNodes as $node) {
                if ($node instanceof \DOMElement) {
                    $index++;
                    $this->count++;
                    $this->items[$index] = new \Celebros\SearchApi\Api\QwiserConcept($node);
                }
            }
        }
	}
}
