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

    protected $validatorPluginManager;

    public function setSessionOptions(SessionOptionsInterface $sessionOptions)
    {
        $this->sessionOptions = $sessionOptions;
    }

    public function getSessionOptions()
    {
        return $this->sessionOptions;
    }

    public function setValidatorPluginManager(ValidatorPluginManager $validatorPluginManager)
    {
        $this->validatorPluginManager = $validatorPluginManager;

        return $this;
    }

    protected function getConfigObject()
    {
        if ($this->getSessionOptions()->getConfigClass()) {
            $configClass = $this->getSessionOptions()->getConfigClass();
            $this->configObject = new $configClass;
            $this->configObject->setOptions($this->getSessionOptions()->getConfigOptions());
        }

        return $this->configObject;
    }

    protected function getStorageObject()
    {
        if ($this->getSessionOptions()->getStorage()) {
            $storageClass = $this->getSessionOptions()->getStorage();
            $this->sessionStorageObject = new $storageClass;
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
        foreach ($this->getSessionOptions()->getValidators() as $validatorName) {
            $validator = $this->validatorPluginManager->get($validatorName);
            $chain->attach('session.validate', array($validator, 'isValid'));
        }

        SessionContainer::setDefaultManager($sessionManager);

        return $sessionManager;
    }

}
