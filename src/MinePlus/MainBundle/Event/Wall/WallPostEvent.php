<?php

namespace MinePlus\MainBundle\Event\Wall;

use MinePlus\MainBundle\Entity\WallPost;

class WallPostEvent extends WallEvent
{
    
    /*
     * @var MinePlus\MainBundle\Entity\WallPost
     */
    protected $post;
    
    public function __construct(WallPost $post)
    {
        $this->setPost($post);
    }
    
    /*
     * @return MinePlus\MainBundle\Entity\WallPost;
     */
    public function getPost()
    {
        return $this->post;
    }
    
    /*
     * @param MinePlus\MainBundle\Entity\WallPost
     */
    public function setPost(WallPost $post)
    {
        $this->post = $post;
        $this->setWall($post->getWall());
    }
    
}

?>
