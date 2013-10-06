<?php

namespace MinePlus\MainBundle\Event\Wall;

use MinePlus\MainBundle\Entity\Wall;
use MinePlus\MainBundle\Event\Event;

class WallEvent extends Event
{
    
    /*
     * @var MinePlus\MainBundle\Entity\Wall
     */
    protected $wall;
    
    /*
     * @param MinePlus\MainBundle\Entity\Wall $wall
     */
    public function __construct(Wall $wall)
    {
        $this->setWall($wall);
    }
    
    /*
     * @return MinePlus\MainBundle\Entity\Wall
     */
    public function getWall()
    {
        return $this->wall;
    }
    
    /*
     * @param MinePlus\MainBundle\Entity\Wall $wall
     */
    public function setWall(Wall $wall)
    {
        $this->wall = $wall;
    }
    
}

?>
