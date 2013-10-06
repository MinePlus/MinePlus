<?php

namespace MinePlus\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WallPost
 */
class WallPost
{
    /**
     * @var integer
     */
    private $id;

    /*
     * @var MinePlus\MainBundle\Entity\User
     */
    private $user;
    
    /**
     * @var string
     */
    private $message;

    private $wall;
    
    /**
     * @var \DateTime
     */
    private $created;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return WallPost
     */
    public function setMessage($message)
    {
        $this->message = $message;
    
        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return WallPost
     */
    public function setCreated($created)
    {
        $this->created = $created;
    
        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set user
     *
     * @param \MinePlus\MainBundle\Entity\User $user
     * @return WallPost
     */
    public function setUser(\MinePlus\MainBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \MinePlus\MainBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set wall
     *
     * @param \MinePlus\MainBundle\Entity\Wall $wall
     * @return WallPost
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