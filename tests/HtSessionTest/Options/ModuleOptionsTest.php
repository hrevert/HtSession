<?php

namespace HtSessionTest\Options;

use HtSession\Options\ModuleOptions;

class ModuleOptionsTest extends \PHPUnit_Framework_TestCase
{
    protected $moduleOptions;

    public function setUp()
    {
        $this->moduleOptions = new ModuleOptions(array(
            'enable_session_set_save_handler' => true,
            'config_class' => 'MyConfigClass',
            'config_options' => array('name' => 'hello'),
            'validators' => array('Zend\Session\Validator\RemoteAddr')
        ));
    }

    public function testSettersAndGetters()
    {
        $this->assertEquals(true, $this->moduleOptions->getEnableSessionSetSaveHandler());
        $this->assertEquals('MyConfigClass', $this->moduleOptions->getConfigClass());
        $this->assertCount(1, $this->moduleOptions->getConfigOptions());
        $this->assertEquals('hello', $this->moduleOptions->getConfigOptions()['name']);
        $this->assertCount(1, $this->moduleOptions->getValidators());
    }

}
