<?php

namespace HtSession;

use Zend\Mvc\MvcEvent;
use Zend\Http\Request as HttpRequest;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $serviceManager = $e->getApplication()->getServiceManager();
        $request = $serviceManager->get('Request');
        if ($request instanceof HttpRequest) {
            $sessionManager = $serviceManager->get('HtSession\Session\Manager');
            $sessionBootstraper = new Session\BootstrapSession($sessionManager);
            $sessionBootstraper->bootstrap();
        }
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            "Zend\Loader\ClassMapAutoloader" => array(
                __DIR__ . "/autoload_classmap.php",
            ),
            "Zend\Loader\StandardAutoloader" => array(
                "namespaces" => array(
                    __NAMESPACE__ => __DIR__ . "/src",
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'HtSession\Session\Manager' => 'HtSession\Factory\SessionManagerFactory',
                'HtSession\ModuleOptions' => 'HtSession\Factory\ModuleOptionsFactory',
                'HtSession\DefaultSessionSetSaveHandler' => 'HtSession\Factory\SessionSetSaveHandlerFactory',
                'HtSession\DoctrineDbalSessionSetSaveHandler' => 'HtSession\Factory\DoctrineDbalSessionSetSaveHandlerFactory',
                'HtSession\Service\ValidatorPluginManager' => 'HtSession\Factory\ValidatorPluginManagerFactory',
            ),
            'aliases' => array(
                'HtSession\SessionSetSaveHandler' => 'HtSession\DefaultSessionSetSaveHandler',
                'HtSessionDbAdapter' => 'Zend\Db\Adapter\Adapter',
            )
        );
    }

}
