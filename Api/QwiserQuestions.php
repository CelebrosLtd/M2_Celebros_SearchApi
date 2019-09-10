<?php
namespace Celebros\SearchApi\Api;
class QwiserQuestions
{
	var $count = 0;
	var $items = [];
	
	public function __construct(\DOMNodeList $xmlQuestions)
	{
        foreach ($xmlQuestions as $questionNode) {
            foreach ($questionNode->childNodes as $node) {
                if ($node instanceof \DOMElement) {
                    $key = $node->getAttribute('Id');
                    $this->count++;
                    $this->items[$key] = new \Celebros\SearchApi\Api\QwiserQuestion($node);
                }
            }
        }
	}
	
	public function getAllQuestions()
    {
		return $this->items;
	}
	
	//get a question by its id .
	public function getQuestionById($id)
	{
		foreach ($this->items as $q) {
			if ($q->id == $id) {
				return $q;
			}
		}
	}
	
	//get all questions with the given side text
	public function getQuestionsBySideText($sideText)
	{
		$qArray = [];	
		foreach ($this->items as $q) {
			if ($q->sideText == $sideText) {
				$qArray[] = $q;	
			}
		}
        
		return 	$qArray;
	}
	
	//get all question with the given text .
	public function getQuestionsByText($guestionText)
	{
		$qArray = [];
		foreach ($this->items as $q) {
			if ($q->text == $guestionText) {
				$qArray[] = $q;	
			}
		}
        
		return $qArray;	
	}
	
	//get all question with the given type .
	public function getQuestionsByType($type)
	{
		$qArray = [];
		foreach ($this->items as $q) {
			if ($q->type == $type) {
				$qArray[] = $q;	
			}
		}
        
		return $qArray;	
	}
} 
