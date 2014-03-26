<?php
namespace HtSession\Service;

use Zend\ServiceManager\AbstractPluginManager;
use Zend\Session\Validator\ValidatorInterface;
use HtSession\Exception;

class ValidatorPluginManager extends AbstractPluginManager
{
    protected $invokableClasses = array(
        'Zend\Session\Validator\RemoteAddr' => 'Zend\Session\Validator\RemoteAddr',
        'Zend\Session\Validator\HttpUserAgent' => 'Zend\Session\Validator\HttpUserAgent',
    );

    public function validatePlugin($plugin)
    {
        if ($plugin instanceof ValidatorInterface) {
            return; // we're okay
        }

        throw new Exception\InvalidArgumentException(sprintf(
            'Plugin of type %s is invalid; must implement Zend\Session\Validator\ValidatorInterface',
            (is_object($plugin) ? get_class($plugin) : gettype($plugin))
        ));
    }
}
