<?php
namespace Celebros\SearchApi\Api;
class QwiserProductAnswers
{
	var $count = 0;
	var $items = [];
    
	public function __construct($xmlProductAnswers)
	{
        foreach ($xmlProductAnswers as $answersNode) {
            foreach ($answersNode->childNodes as $node) {
                if ($node instanceof \DOMElement) {
                    $key = $node->getAttribute('Id');
                    $this->count++;
                    $this->items[$key] = new \Celebros\SearchApi\Api\QwiserProductAnswer($node);
                }
            }
        }
	}
}
