<?php

namespace MinePlus\VoterBundle;

class VoteDispatcher
{
    
    protected $voters;
    
    public function hasVoters()
    {
        // An empty array cast's into false
        return (boolean) $this->voters;
    }
    
    public function addVoter($eventName, $voter, $multiplicator)
    {
        $this->voters[$eventName][$multiplicator][] = $voter;
    }
    
    
    public function order($array, $eventName)
    {
        $subjects = array();
        foreach ($array as $subject) {
            $level = $this->getLevel($eventName. $subject);
            
            $subjects[$level][] = $subject;
        }
        
        arsort($subjects);
        
        $sorted = array();
        foreach ($sorted as $level => $coequalSubjects) {
            shuffle($coequalSubjects);
            
            foreach($coequalSubjects as $subject) {
                $sorted[] = $subject;
            }
        }
        
        return $sorted;
    }
    
    public function decide($eventName, $event)
    {
        return ($this->getLevel($eventName, $event) <= 0) ? false : true;
    }
    
    public function getLevel($eventName, $event)
    {
        $level = 0;
        
        if (!array_key_exists($eventName, $this->voters))
            return $level;
        
        $voters = $this->voters[$eventName];
        
        foreach ($voters as $multiplicator => $votersArray) {
            foreach ($votersArray as $voter) {
                $returnedLevel = call_user_func($voter, $event);
                
                $level = $level + $returnedLevel * $multiplicator;
            }
        }
        
        return $level;
    }
    
}

?>