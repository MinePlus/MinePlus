<?php

namespace MinePlus\MainBundle\Twig;

use Symfony\Component\Routing\Router;

class AvatarExtension extends \Twig_Extension
{
    /*
     * @var Symfony\Component\Routing\Router
     */
    private $router;
    
    public function __construct(Router $router)
    {
        $this->router = $router;
    }
    
    /*
     * Get name of the extension
     * 
     * @return string
     */
    public function getName()
    {
        return 'avatar_extension';
    }
    
    /*
     * Get functions
     * 
     * @return array
     */
    public function getFunctions()
    {
        $function = new \Twig_SimpleFunction('avatar', array($this, 'getAvatar'));
        
        return array($function);
    }
    
    /*
     * Get avatar
     * 
     * @param string $username user to get avatar from
     * @param int $size size of the avatar (px)
     * @param boolean $entireTag render an entire <img> tag
     * 
     * @return string url of the avatar or <img>-tag
     */
    public function getAvatar($username, $size = 128, $entireTag = true)
    {
        $url = $this->router->generate('mineplus_main_avatar', array(
            'username' => $username,
            'size' => $size,
            '_format' => 'png'
        ));
        
        if (!$entireTag) {
            return $url;
        } else {
            return '<img src="'.$url.'" title="'.$username.'" width="'.$size.'" height="'.$size.'" />';
        }
    }
    
}

?>
