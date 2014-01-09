<?php
    
namespace HtSession\Service;

use Zend\Session\Container as SessionContainer;
use Zend\Session\SessionManager as ZendSessionManager;
use Zend\Session\SaveHandler\SaveHandlerInterface;
use HtSession\Options\SessionOptionsInterface;

class SessionManagerProvider
{
    protected $sessionSaveHandler = null;

    protected $configObject = null;

    protected $sessionStorageObject;

    protected $sessionOptions;

    public function setSessionOptions(SessionOptionsInterface $sessionOptions)
    {
        $this->sessionOptions = $sessionOptions;
    }

    public function getSessionOptions()
    {
        return $this->sessionOptions;
    }

    protected function getConfigObject()
    {
        if ($this->getSessionOptions()->getConfigClass()) {
            $this->configObject = new $this->getSessionOptions()->getConfigClass();
            $this->configObject->setOptions($this->getSessionOptions()->setConfigOptions());                 
        }

        return $this->configObject;
    }

    protected function getStorageObject()
    {
        if ($this->getSessionOptions()->getStorage()) {
            $this->sessionStorageObject = new $this->getSessionOptions()->getStorage();
        }
        return $this->sessionStorageObject;
    }

    protected function getSessionSaveHandler()
    {
        return $this->sessionSaveHandler;
    }

    public function setSessionSaveHandler(SaveHandlerInterface $sessionSaveHandler)
    {
        $this->sessionSaveHandler = $sessionSaveHandler;
    }

    public function getSessionManager()
    {
       $sessionManager = new ZendSessionManager(
            $this->getConfigObject(), 
            $this->getStorageObject(), 
            $this->getSessionSaveHandler()
        );

        $chain = $sessionManager->getValidatorChain();
        foreach ($this->validators as $validator) {
            $chain->attach('session.validate', array($validator, 'isValid'));
        }

        SessionContainer::setDefaultManager($sessionManager);
        return $sessionManager;
    }

} 
