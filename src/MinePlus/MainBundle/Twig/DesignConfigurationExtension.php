<?php

namespace MinePlus\MainBundle\Twig;

use Symfony\Component\Yaml\Parser;
use Symfony\Component\HttpKernel\Kernel;

class DesignConfigurationExtension extends \Twig_Extension
{
    
    /*
     * @var Kernel
     */
    private $kernel;
    
    public function __construct(Kernel $kernel)
    {
        $this->kernel = $kernel;
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
     * I do not recommend to use this gobal because when we request a config
     * option that does not exist, the script will abort with an 
     * error/exception.
     * 
     * @return array
     */
    public function getGlobals()
    {
        return array(
            'config' => $this->getConfiguration()
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
            return $this->getOption($key, $default);
        });
        
        return array($function);
    }
    
    /*
     * Get a specific configuration option
     * 
     * @param string $key The key to search in the configuration
     * @param string $default Default value to return if key doesn't exist
     * 
     * @return string|null
     */
    public function getOption($key, $default = null)
    {
        $array = $this->getConfiguration();
        if(array_key_exists($key, $array)) {
            return $array[$key];
        } else {
            // TODO: Write the default to the design.yml file
            return $default;
        }
    }
    
    /*
     * Get configuration
     * 
     * Reads and parses all yaml in 'app/config/design.yml'
     * 
     * @throws ContextErrorException if the design.yml doesn't exist
     * 
     * @return array
     */
    private function getConfiguration()
    {
        $parser = new Parser();
        $array = $parser->parse(file_get_contents($this->kernel->getRootDir().'/config/design.yml'));
        return $array;
    }
    
}

?>
