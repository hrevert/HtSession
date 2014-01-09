<?php

namespace HtSession;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Session\Container as SessionContainer;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $this->bootstrapSession($e);
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
                    __NAMESPACE__ => __DIR__ . "/src/" . __NAMESPACE__,
                ),
            ),
        );
    }

    
    public function bootstrapSession(MvcEvent $e)
    {
        $sm = $e->getApplication()->getServiceManager();
        $sessionManager = $sm->get('HtSession\Session\Manager');
        $sessionBootstraper = new Session\BootstrapSession($sessionManager);
        $sessionBootstraper->bootstrap(); 
        $e->getApplication()->getEventManager()->getSharedManager()->attach('Zend\Mvc\Controller\AbstractController', 'dispatch', function ($e) use ($sm) {            
            $controller = $e->getTarget();
            $acesibilityGuard = $sm->get('HtSession\AccesibilityGuard');
            $acesibilityGuard->setRequestController($controller);
            if (!$acesibilityGuard->isAccessible() && !$sm->get('HtSession\AuthenticationService')->hasIdentity()) {
                return call_user_func_array(array($controller->plugin("redirect"), "toRoute"), (array) $sm->get('HtSession\AccessibilityOptions')->getLoginRoute());
                exit();               
            }
        }, PHP_INT_MAX);
    }
    

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'HtSession\Session\Manager' => 'HtSession\Factory\SessionManagerFactory',
                'HtSession\ModuleOptions' => 'HtSession\Factory\ModuleOptionsFactory',
                'HtSession\AccessibilityOptions' => 'HtSession\Factory\AccessibilityOptionsFactory',
                'HtSession\DefaultSessionSetSaveHandler' => 'HtSession\Factory\SessionSetSaveHandlerFactory'
                'HtSession\AccesibilityGuard' => 'HtSession\Factory\AccesibilityGuardFactory'
            ),
            'aliases' => array(
                'HtSession\SessionSetSaveHandler' => 'HtSession\DefaultSessionSetSaveHandler',
                'HtSession\AuthenticationService' => 'zfcuser_auth_service',
                'HtSessionDbAdapter' => 'Zend\Db\Adapter\Adapter',
            )
        );
    }

}
