<?php

namespace MinePlus\MainBundle\Twig;

use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Dumper;
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
     * Add option
     * 
     * @param string $key key of the new option
     * @param string $value value of the new option
     * 
     * @return null
     */
    public function addOption($key, $value)
    {
        $array = $this->getConfiguration();
        $array[$key] = $value;
        $this->setConfiguration($array);
    }
    
    /*
     * Add multiple options
     * 
     * Merges the existing configuration with the new options
     * 
     * @oaram array $options new options
     * 
     * @return null;
     */
    public function addOptions($options)
    {
        $array = $this->getConfiguration();
        
        // Fixes bug with first migration
        if (!is_array($array)) $array = array();
        
        $array = array_merge($array, $options);
        $this->setConfiguration($array);
    }
    
    /*
     * Get configuration
     * 
     * Reads and parses all yaml in 'app/config/design.yml'
     * 
     * @todo cache the configuration, it should not be re-opened every time
     * 
     * @throws ContextErrorException if the design.yml doesn't exist
     * 
     * @return array
     */
    private function getConfiguration()
    {
        $parser = new Parser();
        $array = $parser->parse(file_get_contents($this->getConfigurationPath()));
        return $array;
    }
    
    /*
     * Set configuration
     * 
     * Replaces the configuration file with the array in the params
     * 
     * @param array $array the new array
     *
     * @return null
     */
    private function setConfiguration($array)
    {
        $dumper = new Dumper();
        $yaml = $dumper->dump($array);
        file_put_contents($this->getConfigurationPath(), $yaml);
    }
    
    
    /*
     * Get Configuration Path
     * 
     * @return string the path of the configuration
     */
    private function getConfigurationPath()
    {
        return $this->kernel->getRootDir().'/config/design.yml';
    }
    
}

?>
