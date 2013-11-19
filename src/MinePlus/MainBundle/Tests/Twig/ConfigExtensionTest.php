<?php

namespace MinePlus\MainBundle\Test\Twig;

use \Mockery as m;
use MinePlus\MainBundle\Twig\ConfigExtension;

class ConfigExtensionTest extends \PHPUnit_Framework_TestCase
{
    
    /*
     * @var \MinePlus\MainBundle\Twig\ConfigExtension
     */
    protected $ex;

    public function setUp()
    {   
        $config = m::mock('\MinePlus\MainBundle\Entity\Config')
            ->shouldReceive('getValue')->times(1)->andReturn(42)
            ->mock();
        
        $repository = m::mock('\Doctrine\ORM\EntityRepository')
            ->shouldReceive('findByName')->times(1)->andReturn($config)
            ->mock();
        
        $entityManager = m::mock('\Doctrine\Common\Persistence\ObjectManager')
            ->shouldReceive('getRepository')->times(1)->andReturn($repository)
            ->mock();
        
        $this->ex = new ConfigExtension($entityManager);
    }
    
    public function tearDown()
    {
        m::close();
    }
    
    public function testExistent()
    {
        $return = $this->ex->getConfig(null);
        $this->assertSame(42, $return);
    }
    
}

?>
