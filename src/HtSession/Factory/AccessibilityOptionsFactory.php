<?php
    
namespace HtSession\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use HtSession\Options\AccessibilityOptions;

class AccessibilityOptionsFactory implements FactoryInterface
{
    /**
     * gets Accessibility Options from configurations
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return AccessibilityOptions
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config');
        $accessConfigArray = isset($config['htsession']['access']) ? $config['htsession']['access'] : array();
        return new AccessibilityOptions($accessConfigArray);
    }
}
