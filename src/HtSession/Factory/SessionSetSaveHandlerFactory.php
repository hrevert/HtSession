<?php

namespace HtSession\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Db\TableGateway\TableGateway;
use Zend\Session\SaveHandler\DbTableGateway;
use Zend\Session\SaveHandler\DbTableGatewayOptions;

class SessionSetSaveHandlerFactory
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $tableGateway = new TableGateway('session', $sm->get('HtSessionDbAdapter'));
        return new DbTableGateway($tableGateway, new DbTableGatewayOptions());
    }
}
