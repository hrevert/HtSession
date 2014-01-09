<?php

namespace HtSession\Session;

use Zend\Session\Container as SessionContainer;
use Zend\Session\SessionManager as ZendSessionManager;

class BootstrapSession
{
    function __construct(ZendSessionManager $session)
    {
        $this->session = $session;
    }

    public function bootstrap()
    {
        $this->session->start();
        $container = new SessionContainer('initialized');
        if (!isset($container->init)) {
             $this->session->regenerateId(true);
             $container->init = 1;
        } 
                
    }
}
