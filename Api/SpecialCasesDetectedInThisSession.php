<?php
namespace Celebros\SearchApi\Api;
class SpecialCasesDetectedInThisSession
{
	public $count = 0;
	public $items = [];
	
	public function __construct(\DOMNodeList $xmlSpecialCasesDetectedInThisSession)
	{
        $index = 0;
        $xmlSpecialCasesDetectedInThisSession = $xmlSpecialCasesDetectedInThisSession->item(0);
        if ($xmlSpecialCasesDetectedInThisSession->hasChildNodes()) {
            $xml_valuesNodes = $xmlSpecialCasesDetectedInThisSession->childNodes;
            foreach ($xml_valuesNodes as $node) {
                $this->items[$i] = $node->nodeValue;
                $index++;
            }
        }
	}
	
	public function toSimpleString() {
		return implode("^", $this->items);
	}
}