<?php

namespace MinePlus\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MinePlus\MainBundle\Entity\Wall;
use MinePlus\MainBundle\Entity\WallPost;
use MinePlus\MainBundle\Event\Events;
use MinePlus\MainBundle\Event\Wall\WallPostEvent;

class UserController extends Controller
{
    public function listAction()
    {
        $users = $this->get('fos_user.user_manager')->findUsers();
        
        $usersToView = array();
        
        if ($this->get('security.context')->isGranted('ROLE_USER')) {
            $me = $this->get('security.context')->getToken()->getUser();
            
            foreach ($users as $user) {
                if ($user->getUsername() != $me->getUsername()) 
                    $usersToView[] = $user;
            }
        } else {
            $usersToView = $users;
        }
        
        return $this->render('MinePlusMainBundle:Player:list.html.twig', array(
            'users' => $usersToView
        ));
    }
    
    public function showAction($username)
    {
        $request = $this->getRequest();
        $user = $this->get('fos_user.user_manager')->findUserByUsername($username);
        $manager = $this->getDoctrine()->getManager();
        
        
        if ($user->getWall() == null) {
            $wall = new Wall();
            $wall->setUser($user);
            
            $manager->persist($wall);
        } else {
            $wall = $user->getWall();
        }
        
        if ($request->request->has('submit_wallpost')) { // If post has been submitted
            $post = new WallPost();
            $post->setWall($wall);
            $post->setUser($this->getUser());
            $post->setMessage($request->request->get('text'));
            $post->setCreated(new \DateTime());
            
            $event = $this->get('event_dispatcher')->dispatch(Events::WALL_POST, new WallPostEvent($post));
            
            if (!$event->willBeDeleted()) {
                $manager->persist($event->getPost());
            }
        }
        
        $manager->flush();
        
        return $this->render('MinePlusMainBundle:Player:show.html.twig', array(
            'user' => $this->get('fos_user.user_manager')->findUserByUsername($username)
        ));
    }

}
