<?php

namespace HtSession\Options;

use Zend\Session\Validator\ValidatorInterface;

interface SessionOptionsInterface
{
    public function setEnableSessionSetSaveHandler($enableSessionSetSaveHandler);

    public function getEnableSessionSetSaveHandler();

    public function setConfigClass($configClass);

    public function getConfigClass();

    public function setConfigOptions($configOptions) ;

    public function setStorage($storage);

    public function getStorage();

    public function setValidators(array $validators);

    public function getValidators();

    public function addValidator(ValidatorInterface $validator)

}
