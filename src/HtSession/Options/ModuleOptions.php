<?php

namespace HtSession\Options;

use Zend\Stdlib\AbstractOptions;

class ModuleOptions extends AbstractOptions implements SessionOptionsInterface
{
    protected $enableSessionSetSaveHandler = true;

    protected $configClass = "Zend\Session\Config\SessionConfig";

    protected $configOptions = array();

    protected $storage = "Zend\Session\Storage\SessionArrayStorage";

    protected $validators = array();

    public function setEnableSessionSetSaveHandler($enableSessionSetSaveHandler)
    {
        $this->enableSessionSetSaveHandler = (bool) $enableSessionSetSaveHandler;
    }

    public function getEnableSessionSetSaveHandler()
    {
        return $this->enableSessionSetSaveHandler;
    }

    public function setConfigClass($configClass)
    {
        $this->configClass = $configClass;
    }

    public function getConfigClass()
    {
        return $this->configClass;
    }

    public function setConfigOptions($configOptions)
    {
        $this->configOptions = $configOptions;
    }

    public function getConfigOptions()
    {
        return $this->configOptions;
    }

    public function setStorage($storage)
    {
        $this->storage = $storage;
    }

    public function getStorage()
    {
        return $this->storage;
    }

    public function setValidators(array $validators)
    {
        foreach ($validators as $validator) {
            $this->addValidator($validator);
        }
    }

    public function addValidator($validator)
    {
        $this->validators[] = $validator;
    }

    public function getValidators()
    {
        return $this->validators;
    }

}
