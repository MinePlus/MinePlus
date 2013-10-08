<?php

namespace MinePlus\DesignBundle\Tests\Navbar;

use MinePlus\DesignBundle\Navbar\Item;

class ItemTest extends \PHPUnit_Framework_TestCase
{
    
    public function testLabel()
    {
        $item = new Item();
        
        // Check default label
        $this->assertNull($item->getLabel());
        
        // Check setter method
        $item->setLabel('label');
        $this->assertEquals($item->getLabel(), 'label');
    }
    
    public function testUrl()
    {
        $item = new Item();
        
        // Check default label
        $this->assertEquals($item->getUrl(), '#');
        
        // Check setter method
        $item->setUrl('http://example.org');
        $this->assertEquals($item->getUrl(), 'http://example.org');
    }
    
}
?>
