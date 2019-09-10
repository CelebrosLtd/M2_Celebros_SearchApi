<?php
namespace Celebros\SearchApi\Api;
class QwiserQuestion
{
	public $id;
	public $rank;
	public $sideText;
	public $text;
	public $type;
	public $hasMoreAnswers;
	public $extraAnswers;
	public $dynamicProperties;
	public $answers;
	
	public function __construct(\DOMElement $questionNode)
	{
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $helper = $objectManager->get('Celebros\SearchApi\Helper\Data');  
        
		$this->id = $questionNode->getAttribute("Id");
		$this->rank = $questionNode->getAttribute("Rank");
		$this->sideText = $questionNode->getAttribute("SideText");
		$this->text	= $questionNode->getAttribute("Text");
		$this->type = $questionNode->getAttribute("Type");
		$this->answers = new \Celebros\SearchApi\Api\QwiserAnswers($questionNode->getElementsByTagName("Answers"));
		$this->extraAnswers = new \Celebros\SearchApi\Api\QwiserAnswers($questionNode->getElementsByTagName("ExtraAnswers"));
		$this->hasMoreAnswers = ($this->extraAnswers->count > 0) ? true : false;
			
		$questionDynamicProperties = null;
		$childNodes = $questionNode->hasChildNodes() ? $questionNode->childNodes : [];
		foreach ($childNodes as $node) {
			if ($node->nodeName == "DynamicProperties") {
				$questionDynamicProperties = $node;
			}
		}
		
		$this->dynamicProperties = $helper->getQwiserSimpleStringDictionary($questionDynamicProperties);
	}
}
