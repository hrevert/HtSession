<?php

namespace HtSession\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use HtSession\Service\SessionManagerProvider;

class SessionManagerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = $serviceLocator->get('HtSession\ModuleOptions');
        $provider = new SessionManagerProvider();
        $provider->setSessionOptions($options);
        if ($options->getEnableSessionSetSaveHandler() === true) {
            $provider->setSessionSaveHandler($serviceLocator->get('HtSession\SessionSetSaveHandler'));
        }
        $provider->setValidatorPluginManager($serviceLocator->get('HtSession\Service\ValidatorPluginManager'));

        return $provider->getSessionManager();
    }
}
