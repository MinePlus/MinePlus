<?php

namespace MinePlus\MainBundle\Tests\Twig;

use MinePlus\MainBundle\Twig\AvatarExtension;

class AvatarExtensionTest extends \PHPUnit_Framework_TestCase
{
    
    /*
     * The AvatarExtension to test.
     * 
     * @var \MinePlus\MainBundle\Twig\AvatarExtension
     */
    protected $ex;
    
    public function __construct()
    {
        $router = $this->getMockBuilder('\Symfony\Component\Routing\Router')
            ->disableOriginalConstructor()
            ->getMock('\Symfony\Component\Routing\Router');
        
        $router->expects($this->any())
            ->method('generate')
            ->will($this->returnArgument('http://example.org'));
        
        $this->ex = new AvatarExtension($router);
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
