<?php
namespace Celebros\SearchApi\Api;
class QwiserAnswer
{
    public $id;
    public $imageHeight;
    public $imageSku;
    public $imageUrl;
    public $imageWidth;
    public $productCount;
    public $text;
    public $type;
    public $dynamicProperties;
    
    public function __construct(\DOMElement $answerNode)
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $helper = $objectManager->get('Celebros\SearchApi\Helper\Data');        
        
        $this->id = $answerNode->getAttribute("Id");
        $this->imageHeight = $answerNode->getAttribute("ImageHeight");
        $this->imageSku = $answerNode->getAttribute("ImageSku");
        $this->imageUrl = $answerNode->getAttribute("ImageUrl");
        $this->imageWidth = $answerNode->getAttribute("ImageWidth");
        $this->productCount = $answerNode->getAttribute("ProductCount");
        $this->text = $answerNode->getAttribute("Text");
        $this->type = $answerNode->getAttribute("Type");
           
        $this->dynamicProperties = $helper->getQwiserSimpleStringDictionary($answerNode->getElementsByTagName("DynamicProperties"));
    }
}
