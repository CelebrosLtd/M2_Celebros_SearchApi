<?php
namespace Celebros\SearchApi\Api;
class QwiserAnsweredAnswer
{
    var $answerId;
    var $effectOnSearchPath;

    public function __construct(\DOMElement $answeredAnswerNode)
    {
        $this->answerId = $answeredAnswerNode->getAttribute("AnswerID");
        $this->effectOnSearchPath = $answeredAnswerNode->getAttribute("EffectOnSearchPath");
    }
}
