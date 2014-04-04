<?php

namespace HtSession\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use HtSession\Session\SaveHandler\DoctrineDbal;
use HtSession\Session\SaveHandler\DoctrineDbalOptions;

class DoctrineDbalSessionSetSaveHandlerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new DoctrineDbal($serviceLocator->get('doctrine.connection.orm_default'), new DoctrineDbalOptions());
    }
}
