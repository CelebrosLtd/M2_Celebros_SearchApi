<?php
namespace Celebros\SearchApi\Api;
class QwiserProductAnswer 
{
	public $id;
	public $name;
	public $questionId;
	public $sku;
	
	public function __construct(\DOMElement $productAnswerNode)
	{
    	$this->id = $productAnswerNode->getAttribute("Id");
		$this->name = $productAnswerNode->getAttribute("Name");
		$this->questionId = $productAnswerNode->getAttribute("QuestionId");
		$this->sku = $productAnswerNode->getAttribute("Sku");
	}
}
