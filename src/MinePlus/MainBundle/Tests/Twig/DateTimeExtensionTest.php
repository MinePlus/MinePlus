<?php

namespace MinePlus\MainBundle\Tests\Twig;

use MinePlus\MainBundle\Twig\DateTimeExtension;

class DateTimeExtensionTest extends \PHPUnit_Framework_TestCase
{
    
    public function testResult()
    {
        $ex = new DateTimeExtension();
        
        $this->assertInternalType('string', $ex->timeDiff(new \DateTime()));
    }
    
}

?>
