<?php

namespace HtSessionTest\Factory;

use Zend\ServiceManager\ServiceManager;
use HtSession\Factory\ModuleOptionsFactory;

class ModuleOptionsFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testFactoryWithOutConfig()
    {
        $serviceManager = new ServiceManager();
        $serviceManager->setService('Config', []);
        $factory = new ModuleOptionsFactory;
        $this->assertInstanceOf('HtSession\Options\ModuleOptions', $factory->createService($serviceManager));
    }

    public function testFactoryWithConfig()
    {
        $serviceManager = new ServiceManager();
        $serviceManager->setService('Config', ['htsession' => ['options' => []]]);
        $factory = new ModuleOptionsFactory;
        $this->assertInstanceOf('HtSession\Options\ModuleOptions', $factory->createService($serviceManager));
    }
}
