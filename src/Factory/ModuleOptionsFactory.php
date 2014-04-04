<?php

namespace HtSession\Factory;

use Zend\ServiceManager\FactoryInterface;
use HtSession\Options\ModuleOptions;
use Zend\ServiceManager\ServiceLocatorInterface;

class ModuleOptionsFactory implements FactoryInterface
{
    /**
     * gets Module Options from config
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return ModuleOptions
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config');
        $moduleConfigArray = isset($config['htsession']['options']) ? $config['htsession']['options'] : array();

        return new ModuleOptions($moduleConfigArray);
    }
}
