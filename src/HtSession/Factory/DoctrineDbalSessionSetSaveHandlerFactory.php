<?php
    
namespace HtSession\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Db\TableGateway\TableGateway;
use HtSession\Session\SaveHandler\DoctrineDbalTableGateway as DbTableGateway;
use HtSession\Session\SaveHandler\DoctrineDbalTableGatewayOptions as DbTableGatewayOptions;

class DoctrineDbalSessionSetSaveHandlerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new DbTableGateway($serviceLocator->get('HtSessionDoctrineDbalConnection'), new DbTableGatewayOptions());        
    }
}
