<?php

namespace MinePlus\MainBundle\Twig;

use Carbon\Carbon;

class DateTimeExtension extends \Twig_Extension
{
    
    /*
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'datetime_extension';
    }
    
    /*
     * {@inheritDoc}
     */
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('time_diff', array($this, 'timeDiff'))
        );
    }
    
    /*
     * Calculates a human-readable time difference.
     * 
     * @todo Either improve the Carbon library or create our own class to calc date/time-differences.
     * 
     * @param \DateTime $start starting point
     * @param \DateTime $end ending point, defaults to now
     * 
     * @return string human-readable time difference string
     */
    public function timeDiff(\DateTime $start, \DateTime $end = null)
    {
        if ($end == null) $end = new \DateTime();
        
        // Convert DateTime instances to Carbon ones
        $start = Carbon::instance($start);
        $end = Carbon::instance($end);
        
        return $start->diffForHumans($end);
    }
    
}

?>
