<?php

namespace HtSession\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use HtSession\Service\AccesibilityGuard;

class AccesibilityGuardFactory implements FactoryInterface
{
    /**
     * gets Accesibility Guard
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return AccesibilityGuard
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $guard = new AccesibilityGuard();
        $guard->setAccessibilityOptions($serviceLocator->get('HtSession\AccessibilityOptions'));
        return $guard;
    }    
}
