<?php

namespace MinePlus\DesignBundle\Tests\Navbar;

use MinePlus\DesignBundle\Navbar\Navbar;
use MinePlus\DesignBundle\Navbar\item;

class NavbarTest extends \PHPUnit_Framework_TestCase
{
    
    public function testCategory()
    {
        $navbar = new Navbar();
        
        // Check default category
        $this->assertEquals($navbar->getCategory(), Navbar::CATEGORY_DEFAULT);
        
        // Check the categories are not equal
        $this->assertNotEquals(Navbar::CATEGORY_ADMIN, Navbar::CATEGORY_DEFAULT);
    }
    
    public function testColor()
    {
        $navbar = new Navbar();
        
        // Check default color
        $this->assertEquals($navbar->getColor(), Navbar::COLOR_UNDEFINED);
        
        // Check setter method
        $navbar->setColor(Navbar::COLOR_BLACK);
        $this->assertEquals($navbar->getColor(), Navbar::COLOR_BLACK);
    }
    
    public function testItems()
    {
        $navbar = new Navbar();
        
        // Check whether items is an instance of a collection
        $this->assertInstanceOf('Doctrine\Common\Collections\Collection', $navbar->getItems());
        
        // Check whether there are no items by default
        $this->assertTrue($navbar->getItems()->isEmpty(), 'Navbar has items by default.');
    }
    
}

?>
