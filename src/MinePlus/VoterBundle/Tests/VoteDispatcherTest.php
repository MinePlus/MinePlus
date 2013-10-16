<?php

namespace MinePlus\VoterBundle\Tests;

use \Mockery as m;

use MinePlus\VoterBundle\VoteDispatcher;

class VoteDispatcherTest extends \PHPUnit_Framework_TestCase
{
    
    public function testVotersProperlyCounted()
    {
        $dispatcher = new VoteDispatcher();
        
        $this->assertFalse($dispatcher->hasVoters());
        
        $dispatcher->addVoter('foo.bar', 'foo', 10);
        
        $this->assertTrue($dispatcher->hasVoters());
    }
    
    public function testVoterGetsCalled()
    {
        $dispatcher = new VoteDispatcher();
        
        $voter = m::mock('stdClass');
        $voter->shouldReceive('onFooBar')->times(1)->andReturn(1);
        
        $dispatcher->addVoter('foo.bar', array($voter, 'onFooBar'), 10);
        $dispatcher->getLevel('foo.bar', new \stdClass());
    }
    
    public function testMultiplicator()
    {
        $dispatcher = new VoteDispatcher();
        
        $voter = m::mock('stdClass');
        $voter->shouldReceive('onFooBar')->andReturn(2);
     
        $dispatcher->addVoter('foo.bar', array($voter, 'onFooBar'), 20);
        $level = $dispatcher->getLevel('foo.bar', new \stdClass());
        
        $this->assertSame($level, 40);
    }
    
    public function testDecisionIsCorrect()
    {
        $dispatcher = new VoteDispatcher();
        
        $voter1 = m::mock('stdClass');
        $voter1->shouldReceive('onFoo')->andReturn(1);
        
        $voter2 = m::mock('stdClass');
        $voter2->shouldReceive('onBar')->andReturn(-1);
        
        $dispatcher->addVoter('foo', array($voter1, 'onFoo'), 10);
        $dispatcher->addVoter('bar', array($voter2, 'onBar'), 10);
        
        $this->assertTrue($dispatcher->decide('foo', new \stdClass()));
        $this->assertFalse($dispatcher->decide('bar', new \stdClass()));
    }
    
}

?>
