<?php
namespace Celebros\SearchApi\Api;
class QwiserProductField 
{
	public $fieldType;
	public $name;
	
	public function __construct(\DOMElement $productFieldNode)
	{
     	$this->fieldType = $productFieldNode->getAttribute("FieldType");
		$this->name = $productFieldNode->getAttribute("Name");
	}
}
