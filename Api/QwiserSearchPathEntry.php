<?php
namespace Celebros\SearchApi\Api;
class QwiserSearchPathEntry 
{
    var $answerIndex;
    var $answers;
    var $questionId;
    
    public function __construct(\DOMElement $entryNode)
    {        
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $helper = $objectManager->get('Celebros\SearchApi\Helper\Data');
        $this->answerIndex = $entryNode->getAttribute("AnswerIndex");
        $this->questionId = $entryNode->getAttribute("QuestionID");
        if ($entryNode->hasChildNodes()) {       
            $this->answers =  new \Celebros\SearchApi\Api\QwiserAnswers($helper->getDomElements($entryNode->childNodes));
        } else {
            $this->answers = [];    
        }
    }
}