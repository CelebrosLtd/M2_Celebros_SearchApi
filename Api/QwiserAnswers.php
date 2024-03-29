<?php
namespace Celebros\SearchApi\Api;
class QwiserAnswers
{
	var $count = 0;
	var $items = [];
	
	public function __construct($xmlAnswers)
	{
        $index = 0;
        if ($xmlAnswers instanceof \DOMNodeList) {
            foreach ($xmlAnswers as $answerNode) {
                if ($answerNode->hasChildNodes()) {
                    foreach ($answerNode->childNodes as $node) {
                        if ($node instanceof \DOMElement) {
                            $index++;
                            $this->count++;
                            $this->items[$index] = new \Celebros\SearchApi\Api\QwiserAnswer($node);
                        }
                    }
                }
            }
        } elseif ($xmlAnswers instanceof \DOMElement) {
            print_r(get_class($xmlAnswers));die;
        }
        
        
		/*//if we got an array of QwiserAnswer
		if(is_array($xml_Answers))
		{
			$this->Items = $xml_Answers;
			$this->Count = count($xml_Answers);
		}
		//if we got a node of QwiserAnswers
		else
		{	
			if(is_object($xml_Answers))
			{	
				$xml_AnswersNodes = $xml_Answers->child_nodes();
				$xml_AnswersNodes = getDomElements($xml_AnswersNodes);
				$this->Count = count($xml_AnswersNodes);

				for ($i = 0 ; $i <= $this->Count - 1;$i++)
				{
					$AnswerNode = $xml_AnswersNodes[$i];
					$this->Items[$i] = Mage::getModel('conversionpro/Api_QwiserAnswer', $AnswerNode);
				}
			}
		}*/
	}
	
	//Return Answer By Id.
	Function GetAnswerById($ID)
	{
		foreach ($this->Items as $Ans)
		{
			if($Ans->Id==$ID)
			{
				return $Ans;
			}
		}
	}
	
	//Gets a QwiserAnswers object of all answers in this collection that have the specified text 
	Function GetAnswersByText($Text)
	{
		$ansArray = array();
		foreach ($this->Items as $Ans)
		{
			if($Ans->Text = $Text)
			{
				$ansArray[] = $Ans;	
			}
		}
		return Mage::getModel('conversionpro/Api_QwiserAnswer', $ansArray);
	}
	
	//Gets a QwiserAnswers object of all answers in this collection that are of the specified type
	Function GetAnswersByType($Type)
	{
		$ansArray = array();
		foreach ($this->Items as $Ans)
		{
			if($Ans->Type = $Type)
			{
				$ansArray[] = $Ans;
			}
		}	
		return Mage::getModel('conversionpro/Api_QwiserAnswer', $ansArray);
	}
	
	//Sorts This QwiserAnswers collection with CompareTo method. 
	Function SortByAnswerText()
	{
		usort($this->Items,array("QwiserAnswers","CompareTo"));
	}
	
	Function CompareTo($a,$b)
	{
		$al = strtolower($a->Text);
       	$bl = strtolower($b->Text);
       	if ($al == $bl) {
           return 0;
       	}
      	 return ($al > $bl) ? +1 : -1;
		//return strcmp($a1,$b1);
	}
	

}
