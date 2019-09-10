<?php
namespace Celebros\SearchApi\Api;
class QwiserSearchPath
{
	var $count = 0;
	var $items = [];
	
	public function __construct(\DOMNodeList $xmlSearchPath)
	{
        $index = 0;
        foreach ($xmlSearchPath as $pathNode) {
            foreach ($pathNode->childNodes as $node) {
                if ($node instanceof \DOMElement) {
                    $index++;
                    $this->count++;
                    $this->items[$index] = new \Celebros\SearchApi\Api\QwiserSearchPathEntry($node);
                }
            }        
        }
	} 
}
