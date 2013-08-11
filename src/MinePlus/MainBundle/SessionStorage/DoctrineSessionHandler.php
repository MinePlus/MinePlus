<?php

namespace MinePlus\MainBundle\SessionStorage;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityNotFoundException;
use MinePlus\MainBundle\Entity\Session;

class DoctrineSessionHandler implements \SessionHandlerInterface
{
    
    /*
     * @var Doctrine\Bundle\DoctrineBundle\Registry
     */
    protected $doctrine;
    
    /*
     * Set the internal doctrine object
     * 
     * @param Doctrine\Bundle\DoctrineBundle\Registry $doctrine Doctrine
     */
    public function setDoctrine(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }
    
    /*
     * Get the internal doctrine object
     * 
     * @return Doctrine\Bundle\DoctrineBundle\Registry Doctrine
     */
    protected function getDoctrine()
    {
        return $this->doctrine;
    }
    
    /*
     * Query for a session entity by id
     * Note: If there are more than one session having the given session id,
     * only the first one will be returned.
     * 
     * @param int $sessionId session id of the session
     * 
     * @return MinePlus\MainBundle\Entity\Session
     */
    protected function getSessionEntity($sessionId)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('MinePlusMainBundle:Session');
        
        $session = $repository->findBySessionId($sessionId);
        
        if (!$session) {
            throw new EntityNotFoundException('The session searched for was not found!');
        } else {
            return $session[0];
        }
    }
    
    protected function createSessionEntity($sessionId, $data)
    {   
        $em = $this->getDoctrine()->getManager();
        
        $session = new Session();
        $session->setSessionId($sessionId);
        $session->setData($data);
        $session->setCreated(new \DateTime());

        $em->persist($session);
        $em->flush();
        
        return $session;
    }
    
    /*
     * {@inheritDoc}
     */
    public function open($savePath, $sessionName)
    {
        return true;
    }
    
    /*
     * {@inheritDoc}
     */
    public function close()
    {
        return true;
    }

    /*
     * {@inheritDoc}
     */
    public function destroy($sessionId)
    {   
        $session = $this->getSessionEntity($sessionId);
        
        $em = $this->getDoctrine()->getManager();
        $em->delete($session);
        $em->flush();
    }

    /*
     * {@inheritDoc}
     * 
     * @todo implement this functionality into the session handler
     */
    public function gc($lifetime)
    {
        return true;
    }

    /*
     * {@inheritDoc}
     */
    public function read($sessionId)
    {
        try {
            $session = $this->getSessionEntity($sessionId);
            $data = $session->getData();
        } catch (EntityNotFoundException $e) { // If session doesn't exist
            $session = $this->createSessionEntity($sessionId, base64_encode(null));
            $data = $session->getData();
        }
        
        return base64_decode($data);
    }

    /*
     * {@inheritDoc}
     */
    public function write($sessionId, $data)
    {
        $data = base64_encode($data);
        
        try {
            $session = $this->getSessionEntity($sessionId);
            $session->setData($data);
        } catch (EntityNotFoundException $e) { // If session doesn't exist
            $this->createSessionEntity($sessionId, $data);
            return true;
        }
        
        $em = $this->getDoctrine()->getManager();
        $em->flush();
    }
    
}

?>
