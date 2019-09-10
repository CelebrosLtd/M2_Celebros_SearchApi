<?php
namespace Celebros\SearchApi\Api;
class QwiserAnsweredAnswers
{
    var $count = 0;
    var $items = [];
    
    public function __construct(\DOMNodeList $xmlAnsweredAnswers)
    {
        $xmlAnsweredAnswers = $xmlAnsweredAnswers->item(0);
        if ($xmlAnsweredAnswers->hasChildNodes()) {
            $xmlAnsweredAnswersNodes = $xmlAnsweredAnswers->childNodes;
            foreach ($xmlAnsweredAnswersNodes as $node) {
                if ($node->nodeType == 1) {
                    $this->count++;
                    $key = $node->getAttribute("AnswerID");
                    $this->items[] = new \Celebros\SearchApi\Api\QwiserAnsweredAnswer($node);
                }
            }
        }
    }
    
    public function toSimpleString()
    {
        $builder = "";
        for ($i = 0; $i <= $this->count - 1; $i++) {
            $answer = $this->items[$i];
            $builder .= $answer->answerId;
            $builder .= "^";
            $builder .= $this->_effectOnSearchPathToInt($answer->effectOnSearchPath);
            $builder .= "^";
        }
        
        $builder = substr($builder, 0, -1);
        
        return $builder;
    }
    
    private function _effectOnSearchPathToInt($strEffectOnSearchPath)
    {
        switch ($strEffectOnSearchPath) {
            case "Exclude":
                return 0;
                break;
            case "ExactAnswerNode":
                return 1;
                break;
            case "EntireAnswerPath":
                return 2;
                break;
        }
    }
    
}
