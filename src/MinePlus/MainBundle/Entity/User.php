<?php

namespace MinePlus\MainBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;

class User extends BaseUser
{
    
    /*
     * @var MinePlus\MainBundle\Entity\Wall
     */
    private $wall;
    
    public function __construct()
    {
        parent::__construct();
    }
    

    /**
     * Set wall
     *
     * @param \MinePlus\MainBundle\Entity\Wall $wall
     * @return User
     */
    public function setWall(\MinePlus\MainBundle\Entity\Wall $wall = null)
    {
        $this->wall = $wall;
    
        return $this;
    }

    /**
     * Get wall
     *
     * @return \MinePlus\MainBundle\Entity\Wall 
     */
    public function getWall()
    {   
        return $this->wall;
    }
}