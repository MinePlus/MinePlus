<?php

namespace MinePlus\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ImageController extends Controller
{
    
    /*
     * Url to load the avatar from, defaults to minecraft servers
     * 
     * @var string
     */
    const SKIN_URL = 'http://s3.amazonaws.com/MinecraftSkins/%username%.png';
    
    public function avatarAction($username, $size = 128)
    {
        $fs = $this->get('filesystem');
        $logger = $this->get('logger');
        
        $cacheDir = $this->get('kernel')->getCacheDir().'/avatars/';
        $userDir = $cacheDir.$username.'/';
        $cache = $userDir.$size.'.png';
       
        if (!$fs->exists($cacheDir)) { 
            $logger->info('Created directory '.$cacheDir.'.');
            $fs->mkdir($cacheDir);
        }
        if (!$fs->exists($userDir)) {
            $fs->mkdir($userDir);
            $logger->info('Created directory '.$userDir.'.');
        }
        
        if (!$fs->exists($cache)) { // If the file is not yet cached
            $source = curl_init();
            curl_setopt($source, CURLOPT_URL, str_replace('%username%', $username, self::SKIN_URL));
            curl_setopt($source, CURLOPT_TIMEOUT, 2);
            curl_setopt($source, CURLOPT_RETURNTRANSFER, true);
            $raw = curl_exec($source);
            $status = curl_getinfo($source, CURLINFO_HTTP_CODE);
            curl_close($source);

            if ($status != 200) {
                return new Response(null, $status);
            }

            $skin = imagecreatefromstring($raw);
            $avatar = imagecreatetruecolor($size, $size);

            imagecopyresized($avatar, $skin, 0, 0, 8, 8, $size, $size, 8, 8); // Crop out face
            imagecolortransparent($skin, imagecolorat($skin, 63, 0)); // Fix issue with black hat
            imagecopyresized($avatar, $skin, 0, 0, 40, 8, $size, $size, 8, 8); // Add accessoires

            imagepng($avatar, $cache);
            
            $logger->info('Cached avatar '.$username.'@'.$size.'px to '.$cache);
            
            $response = file_get_contents($cache);
        }
        
        $logger->info('Load avatar '.$username.'@'.$size.'px from '.$cache);
            
        $response = file_get_contents($cache);
        
        return new Response($response, 200, array('Content-Type' => 'image/png'));
    }

}
