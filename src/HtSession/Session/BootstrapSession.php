<?php

namespace HtSession\Session;

use Zend\Session\Container as SessionContainer;
use Zend\Session\SessionManager;

class BootstrapSession
{
    /**
     * @var SessionManager
     */
    protected $sessionManager;

    /**
     * Constructor
     *
     * @param  SessionManager $sessionManager
     * @return void
     */
    public function __construct(SessionManager $sessionManager)
    {
        $this->sessionManager = $sessionManager;
    }

    /**
     * gets SessionManager instance
     *
     * @return SessionManager
     */
    public function getSessionManager()
    {
        return $this->sessionManager;
    }

    /**
     * Initializes sesssion
     *
     * @return void
     */
    public function bootstrap()
    {
        $this->getSessionManager()->start();
        $container = new SessionContainer('initialized');
        if (!isset($container->init)) {
             $this->getSessionManager()->regenerateId(true);
             $container->init = 1;
        }

    }
}
