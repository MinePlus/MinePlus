<?php

namespace MinePlus\MainBundle\Event\Wall;

use MinePlus\MainBundle\Entity\WallPost;

class WallPostEvent extends WallEvent
{
    
    /*
     * If set to true, the post is being deleted instead of being posted.
     * 
     * @var boolean
     */
    protected $delete;
    
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
    
    /*
     * Whether to store the post or not to do.
     * Attention: Every listener may override the value set by the previous one,
     * so be sure to stop propagation if you want your decision to be absolute!
     * 
     * @param boolean $flag If set to true, the post will be deleted.
     */
    public function delete($flag = true)
    {
        $this->delete = $flag;
    }
    
    /*
     * @return boolean
     */
    public function willBeDeleted()
    {
        return $this->delete;
    }
    
}

?>
