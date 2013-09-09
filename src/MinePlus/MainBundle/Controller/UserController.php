<?php

namespace MinePlus\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpFoundation\Request;
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
        $user = $this->get('fos_user.user_manager')->findUserByUsername($username);
        $manager = $this->getDoctrine()->getManager();
        
        
        if ($user->getWall() == null) {
            $wall = new Wall();
            $wall->setUser($user);
            
            $manager->persist($wall);
            $manager->flush();
        } else {
            $wall = $user->getWall();
        }
        
        if ($this->getRequest()->request->has('submit_wallpost')) {
            $this->submitWallPost($this->getRequest(), $wall);
        }
        
        return $this->render('MinePlusMainBundle:Player:show.html.twig', array(
            'user' => $this->get('fos_user.user_manager')->findUserByUsername($username)
        ));
    }
    
    /*
     * Creates a wall post from a request.
     * 
     * @throws Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException If the user tries to post on a wall but is not logged in.
     * 
     * @param Symfony\Component\HttpFoundation\Request $request Request to retrieve wall post data.
     * @param MinePlus\MainBundle\Entity\Wall $wall The wall to post on.
     * 
     * @return boolean True if the post was submitted, false if not.
     */
    protected function submitWallPost(Request $request, Wall $wall)
    {
        $manager = $this->getDoctrine()->getManager();
        
        if ($this->get('security.context')->isGranted('ROLE_USER')) { // If post has been submitted
            $post = new WallPost();
            $post->setWall($wall);
            $post->setUser($this->getUser());
            $post->setMessage($request->request->get('text'));
            $post->setCreated(new \DateTime());

            $event = $this->get('event_dispatcher')->dispatch(Events::WALL_POST, new WallPostEvent($post));

            if (!$event->willBeDeleted()) { // If post may be submitted
                $manager->persist($event->getPost());
                $manager->flush();
                return true;
            } else {
                return false;
            }
        } else {
            throw new AccessDeniedHttpException();
        }
    }

}
