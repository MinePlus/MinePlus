<?php

namespace MinePlus\MainBundle\Twig;

use Doctrine\Common\Persistence\ObjectManager;
use MinePlus\MainBundle\Entity\Config;

class ConfigExtension extends \Twig_Extension
{
    
    /*
     * @var \Doctrine\Common\Persistence\ObjectManager
     */
    protected $entityManager;
    
    /*
     * Constructor
     * 
     * @param \Doctrine\Common\Persistence\ObjectManager $em EntityManager
     */
    public function __construct(ObjectManager $em)
    {
        $this->entityManager = $em;
    }
    
    /*
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'config_extension';
    }
    
    /*
     * {@inheritDoc}
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
        } else if (is_array($config)) {
            $config = $config[0];
        }
        
        return $config->getValue();
    }
    
}

?>
