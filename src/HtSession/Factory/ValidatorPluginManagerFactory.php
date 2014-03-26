<?php
namespace HtSession\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use HtSession\Service\ValidatorPluginManager;
use Zend\ServiceManager\Config;

class ValidatorPluginManagerFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config');
        $validatorsConfig= isset($config['htsession']['validators']) ? $config['htsession']['validators'] : array();

        $pluginManager = new ValidatorPluginManager(new Config($validatorsConfig));
        $pluginManager->setServiceLocator($serviceLocator);

        return $pluginManager;
    }
}
