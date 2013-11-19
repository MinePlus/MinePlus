<?php

namespace MinePlus\MainBundle\Tests\Twig;

use \Mockery as m;
use MinePlus\MainBundle\Twig\AvatarExtension;

class AvatarExtensionTest extends \PHPUnit_Framework_TestCase
{
    
    /*
     * The AvatarExtension to test.
     * 
     * @var \MinePlus\MainBundle\Twig\AvatarExtension
     */
    protected $ex;
    
    public function setUp()
    {   
        $router = m::mock('\Symfony\Component\Routing\Router')
            ->shouldReceive('generate')->andReturn('http://www.example.org')
            ->mock();
        
        $this->ex = new AvatarExtension($router);
    }
    
    public function tearDown()
    {
        m::close();
    }
    
    /*
     * This actually just tests the extension doesn't distort the url.
     */
    public function testUrl()
    {
        // parse_url() returns an array if the url is valid.
        $return = parse_url($this->ex->getAvatar('char'));
        
        $this->assertInternalType('array', $return, 'AvatarExtension->getAvatar($username) doesn\'t return a valid url.');
    }
    
}

?>
