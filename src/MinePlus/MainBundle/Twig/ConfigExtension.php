<?php

namespace MinePlus\MainBundle\Twig;

use Doctrine\Bundle\DoctrineBundle\Registry;
use MinePlus\MainBundle\Entity\Config;

class ConfigExtension extends \Twig_Extension
{
    
    /*
     * @var Doctrine\ORM\EntityManager
     */
    protected $entityManager;
    
    /*
     * Constructor
     * 
     * @param Doctrine\Bundle\DoctrineBundle\Registry $registry Doctrine Registry
     */
    public function __construct(Registry $registry)
    {
        $this->entityManager = $registry->getManager();
    }
    
    /*
     * Get name of the extension
     * 
     * @return string
     */
    public function getName()
    {
        return 'config_extension';
    }
    
    /*
     * Get functions
     * 
     * @return array
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('config', array($this, 'getConfig'))
        );
    }
    
    public function getConfig($name, $default = null)
    {
        $repo = $this->entityManager->getRepository('MinePlusMainBundle:Config');
        $config = $repo->findByName($name);
        
        if (!$config) {
            $config = new Config();
            
            $config->setName($name);
            $config->setValue($default);
            $this->entityManager->persist($config);
            $this->entityManager->flush();
        } else {
            $config = $config[0];
        }
        
        return $config->getValue();
    }
    
}

?>
