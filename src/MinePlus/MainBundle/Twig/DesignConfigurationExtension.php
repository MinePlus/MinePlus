<?php

namespace MinePlus\MainBundle\Twig;

use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Dumper;
use Symfony\Component\HttpKernel\Kernel;
use MinePlus\MainBundle\Config\Config;

class DesignConfigurationExtension extends \Twig_Extension
{
    
    /*
     * @var Config
     */
    private $config;
    
    public function __construct(Kernel $kernel, $yamlInline = 3)
    {
        $this->yamlInline = $yamlInline;
        $path = $kernel->getRootDir().'/config/design.yml';
        $this->config = new Config($path, $yamlInline);
    }
    
    /*
     * Get name of the extension
     * 
     * @return string
     */
    public function getName()
    {
        return 'design_configuration_extension';
    }
    
    /*
     * Get globals
     * 
     * 
     * I do not recommend to use this gobal because when we request a config
     * option that does not exist, the script will abort with an 
     * error/exception.
     * EDIT: Since we use migrations this should be safe!
     * 
     * @return array
     */
    public function getGlobals()
    {
        return array(
            'config' => $this->config->load()
        );
    }
    
    /*
     * Get functions
     * 
     * @return array
     */
    public function getFunctions()
    {
        $function = new \Twig_SimpleFunction('config', function($key, $default = null) {
            return $this->config->getOption($key, $default, true, true);
        });
        
        return array($function);
    }
    
}

?>
