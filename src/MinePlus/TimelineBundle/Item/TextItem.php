<?php

namespace MinePlus\TimelineBundle\Item;

class TextItem implements ItemInterface
{
    
    protected $timestamp;
    
    protected $writer;
    
    protected $text;
    
    public function getTimestamp()
    {
        return $this->timestamp;
    }
    
    public function getWriter()
    {
        return $this->writer;
    }
    
    public function setText($text)
    {
        $this->text = $text;
    }
    
    public function render()
    {
        return '<p>'.$this->text.'</p>';
    }
    
}

?>