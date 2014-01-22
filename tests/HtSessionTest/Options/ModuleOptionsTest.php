<?php
    
namespace HtSessionTest\Options;

use HtSession\Options\ModuleOptions;

class ModuleOptionsTest extends \PHPUnit_Framework_TestCase
{
    protected $moduleOptions;

    public function setUp()
    {
        $this->moduleOptions = new ModuleOptions(array(
            'enable_session_set_handler' => false,
            'config_class' => 'MyConfigClass',
            'config_options' => array('name' => 'hello'),
            'validators' => array('MyValidator')
        ));        
    }

    public function testSettersAndGetters()
    {
        $this->assertEquals(false, $moduleOptions->getEnableSessionSetSaveHandler());
        $this->assertEquals('MyConfigClass', $moduleOptions->getConfigClass());
        $this->assertCount(1, $moduleOptions->getConfigOptions());
        $this->assertEquals('hello', $moduleOptions->getConfigOptions()['name']);
        $this->assertCount(1, $moduleOptions->getValidators());
        //$this->assertTrue(in_array('MyValidator', $moduleOptions->getValidators()));
    }
    
    public function testValidators()
    {
        foreach ($moduleOptions->getValidators() as $validator) {
            $this->assertInstanceOf('Zend\Session\Validator\ValidatorInterface', $validator);
        }
    }    
}
