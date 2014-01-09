<?php

namespace HtSession\Service;

use HtSession\Options\AccessibilityOptionsInterface;

class AccesibilityGuard
{
    protected $requestController;

    protected $accessibilityOptions;

    public function setAccessibilityOptions(AccessibilityOptionsInterface $accessibilityOptions)
    {
        $this->accessibilityOptions = $accessibilityOptions; 
    }

    public function getAccessibilityOptions()
    {
        return $this->accessibilityOptions;
    }

    public function setRequestController($requestController)
    {
        $this->requestController = $requestController;
    }

    public function getRequestController()
    {
        return $this->requestController;
    }

    public function isAccessible()
    {
        $controllerClass = get_class($this->getRequestController());
        $moduleNamespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));
        if (!in_array($moduleNamespace, $this->getAccessibilityOptions()->getModules()) && !in_array($controllerClass, $this->getAccessibilityOptions()->getControllers()['include'])) {
            return false;
        }
        if (in_array($controllerClass, $this->getAccessibilityOptions()->getControllers()['exclude'])) {
            return false;
        }

        return true;
    }

}

