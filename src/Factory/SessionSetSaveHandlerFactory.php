<?php

namespace HtSession\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Db\TableGateway\TableGateway;
use Zend\Session\SaveHandler\DbTableGateway;
use Zend\Session\SaveHandler\DbTableGatewayOptions;

class SessionSetSaveHandlerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $tableGateway = new TableGateway('session', $serviceLocator->get('HtSessionDbAdapter'));

        return new DbTableGateway($tableGateway, new DbTableGatewayOptions());
    }
}
