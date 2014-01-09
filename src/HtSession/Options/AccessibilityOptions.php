<?php

namespace HtSession\Options;

use Zend\Stdlib\AbstractOptions;

class AccessibilityOptions extends AbstractOptions implements AccessibilityOptionsInterface
{
    protected $modules = array();

    protected $controllers = array(
        'include' => array(),
        'exclude' => array(),
    );

    protected $loginRoute = "zfcuser/login";
    
    public function setModules(array $modules)
    {
        $this->modules = $modules;
    }

    public function getModules()
    {
        return $this->modules;
    }

    public function setControllers(array $controllers)
    {
        $this->controllers = $controllers; 
        $this->controllers['include'] = isset($this->controllers['include']) ? $this->controllers['include'] : array();
        $this->controllers['exclude'] = isset($this->controllers['exclude']) ? $this->controllers['exclude'] : array();
    }

    public function getControllers()
    {
        return $this->controllers;
    }
    
    public function setLoginRoute($loginRoute)
    {
        $this->loginRoute = $loginRoute;
    }

    public function getLoginRoute()
    {
        return $this->loginRoute;
    }            
}
