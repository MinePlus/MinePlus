<?php

namespace MinePlus\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Wall
 */
class Wall
{
    /**
     * @var integer
     */
    private $id;

    /*
     * @var MinePlus\MainBundle\Entity\User
     */
    private $user;
    
    /*
     * @var Doctrine\Common\Collections\ArrayCollection
     */
    private $posts;

    public function __construct()
    {
        $this->posts = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
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
     * Set user
     *
     * @param \MinePlus\MainBundle\Entity\User $user
     * @return Wall
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
     * Add posts
     *
     * @param \MinePlus\MainBundle\Entity\WallPost $posts
     * @return Wall
     */
    public function addPost(\MinePlus\MainBundle\Entity\WallPost $post)
    {
        $this->posts[] = $post;
    
        return $this;
    }

    /**
     * Remove posts
     *
     * @param \MinePlus\MainBundle\Entity\WallPost $posts
     */
    public function removePost(\MinePlus\MainBundle\Entity\WallPost $post)
    {
        $this->posts->removeElement($post);
    }

    /**
     * Get posts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPosts()
    {
        return $this->posts;
    }
}