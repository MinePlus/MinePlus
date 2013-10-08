<?php

namespace MinePlus\MainBundle\Test\Twig;

use MinePlus\MainBundle\Twig\ConfigExtension;

class ConfigExtensionTest extends \PHPUnit_Framework_TestCase
{
    
    /*
     * @var \MinePlus\MainBundle\Twig\ConfigExtension
     */
    protected $ex;

    public function __construct()
    {
        $config = $this->getMock('\MinePlus\MainBundle\Entity\Config');
        $config->expects($this->once())
            ->method('getValue')
            ->will($this->returnValue(42));
        
        $repository = $this->getMockBuilder('\Doctrine\ORM\EntityRepository')
            ->disableOriginalConstructor()
            ->getMock();
        $repository->expects($this->once())
            ->method('__call')
            ->will($this->returnValue($config));
        
        $entityManager = $this->getMockBuilder('\Doctrine\Common\Persistence\ObjectManager')
            ->disableOriginalConstructor()
            ->getMock();
        $entityManager->expects($this->once())
            ->method('getRepository')
            ->will($this->returnValue($repository));
        
        $this->ex = new ConfigExtension($entityManager);
    }
    
    public function testExistent()
    {
        $return = $this->ex->getConfig(null);
        $this->assertSame(42, $return);
    }
    
}

?>
