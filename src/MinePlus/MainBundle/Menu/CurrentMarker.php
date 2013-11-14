<?php

namespace MinePlus\MainBundle\Menu;

use Knp\Menu\ItemInterface;
use Knp\Menu\Iterator\RecursiveItemIterator;
use Symfony\Component\HttpFoundation\Request;

class CurrentMarker
{
    
    protected $request;
    
    /*
     * @param \Symfony\Component\HttpFoundation\Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    
    /*
     * Checks whether the url's of the given item and it's childs are the current one.
     * 
     * @todo increase depth
     * 
     * @param \Knp\Menu\ItemInterface The item to check.
     * @param bool $markRoot Whether to check the root url, too.
     * 
     * @return Knp\Menu\ItemInterface The marked item.
     */
    public function mark(ItemInterface $menu)
    {
        $itemIterator = new RecursiveItemIterator($menu);
        $iterator = new \RecursiveIteratorIterator($itemIterator, \RecursiveIteratorIterator::SELF_FIRST);
        
        foreach ($iterator as $item) {
            if ($this->isCurrent($item->getUri()))
                $item->setCurrent(true);
        }
        
        return $menu;
    }
    
    /*
     * @param string $url
     * 
     * @return bool true if the given url is the current one.
     */
    protected function isCurrent($url)
    {
        return $url == $this->request->getRequestUri();
    }
    
}

?>
