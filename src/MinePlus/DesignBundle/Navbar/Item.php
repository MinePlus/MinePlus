<?php

namespace MinePlus\DesignBundle\Navbar;

class Item
{
    
   protected $url;
   
   protected $label;
   
   public function __construct($label = null, $url = '#')
   {
       $this->label = $label;
       $this->url = $url;
   }
   
   /*
    * @param string $label
    */
   public function setLabel($label)
   {
       $this->label = $label;
   }
   
   /*
    * @return string
    */
   public function getLabel()
   {
       return $this->label;
   }
   
   /*
    * @param string $url
    */
   public function setUrl($url)
   {
       $this->url = $url;
   }
   
   /*
    * @return string
    */
   public function getUrl()
   {
       return $this->url;
   }
    
}

?>
