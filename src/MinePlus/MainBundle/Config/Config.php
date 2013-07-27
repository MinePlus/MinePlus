<?php

namespace MinePlus\MainBundle\Config;

use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Dumper;

class Config
{    
    
    /*
     * @var string
     */
    public $path;
    
    /*
     * @var int
     */
    public $yamlInline;
    
    /*
     * Cached version of the config
     * 
     * @var array
     */
    public $config;
    
    /*
     * Constructor
     * 
     * @param string $path path of the configuration
     * @param int $yamlInline level of indentation
     */
    public function __construct($path, $yamlInline = 3)
    {
        $this->path = $path;
        $this->yamlInline = $yamlInline;
        $this->load();
    }
    
    /*
     * Get an option from the config
     * 
     * @param string $key key of the option
     * @param mixed $default default to return if key does not exists
     * @param boolean $writeDefaultIfNotExists write the default to config, if key doesn't exist
     * @param boolean $save safe after setting
     * 
     * @return mixed
     */
    public function getOption($key, $default = null, $writeDefaultIfNotExists = true, $save = false)
    {
        $config = $this->load();
        if (array_key_exists($key, $config)) { // if the key exists
            return $config[$key];
        } else {
            if ($writeDefaultIfNotExists) $this->setOption($key, $default, $save);
            return $default;
        }
    }
    
    /*
     * Adds options
     * 
     * @param array $options array of options
     * @param boolean $save save after setting
     */
    public function setOptions($options, $save = false)
    {
        array_merge($this->config, $options);
        if ($save) $this->save();
    }
    
    /*
     * Add a single option
     * 
     * @param string $key key of the option
     * @param mixed $value value of the option
     * @param boolean $save save after setting
     */
    public function setOption($key, $value, $save = false)
    {
        $this->setOptions(array($key => $value), $save);
    }
    
    /*
     * Get path of the configuration
     * 
     * @return string path
     */
    public function getPath()
    {
        return $this->path;
    }
    
    /*
     * Get the configuration
     * 
     * @return array
     */
    public function load()
    {
        if(!isset($this->config)) { // If the config hasn't been cached yet
            $parser = new Parser();
            $array = $parser->parse(file_get_contents($this->getPath()));
            $this->config = $array; // Save the file to the cache
            return $array;
        } else {
            return $this->config;
        }
    }
    
    /*
     * Saves the current config from the cache
     * 
     * @throws Exception if the cache is empty
     */
    public function save() {
        if (!isset($this->config)) 
            throw new Exception('Config is not written to the cache');
        
        $dumper = new Dumper();
        $yaml = $dumper->dump($dumper, $this->yamlInline);
        file_put_contents($this->getPath(), $yaml);
    }
    
}

?>
