<?php

require_once __DIR__ . "/__bootstrap__.php";

use Pilulka\Core\Exception\ServiceManagerException;

class ServiceManagerTest extends PHPUnit_Framework_TestCase
{

    /** @var FooServiceManager */
    private $manager;

    public function setUp()
    {
        $this->manager = new FooServiceManager();
        $this->manager->addService('a', new FooService('a'));
        $this->manager->addService('b', new FooService('b'));
        $this->manager->addService('c', new FooService('c'));
        $this->manager->setDefault('b');
    }

    public function testInstanceReturnsDefault()
    {
        $this->assertEquals($this->manager->instance()->name(), 'b');
    }

    public function testAccessToInstanceByName()
    {
        $this->assertEquals($this->manager->instance('a')->name(), 'a');
        $this->assertEquals($this->manager->instance('b')->name(), 'b');
        $this->assertEquals($this->manager->instance('c')->name(), 'c');
    }

    public function testIfNonExistingInstanceThrowsException()
    {
        $this->expectException(ServiceManagerException::class);
        $this->expectExceptionMessageRegExp('~(`z` is not defined)~');
        $this->manager->instance('z')->name();
    }

}