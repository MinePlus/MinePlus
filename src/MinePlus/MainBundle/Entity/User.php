<?php

namespace MinePlus\MainBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;

class User extends BaseUser
{
    
    public function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get url of avatar
     * 
     * @param int $size Sife of the avatar (px)
     * 
     * @return string url
     */
    public function getAvatarUrl($size = 50)
    {
        return 'https://minotar.net/avatar/'.$this->getUsername().'/'.$size.'.png';
    }
    
}
