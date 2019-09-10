<?php
namespace Celebros\SearchApi\Api;
class QwiserConcept 
{
	public $id;
	public $name;
	public $rank;
	public $type;
	public $dynamicProperties;
	
	public function __construct(\DOMElement $conceptNode)
	{
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $helper = $objectManager->get('Celebros\SearchApi\Helper\Data');        
        
    	$this->id = $conceptNode->getAttribute("Id");
		$this->name = $conceptNode->getAttribute("Name");
		$this->rank = $conceptNode->getAttribute("Rank");
		$this->type = $conceptNode->getAttribute("Type");
        
		$this->dynamicProperties = $helper->getQwiserSimpleStringDictionary($conceptNode->getElementsByTagName("DynamicProperties"));
	}
}
