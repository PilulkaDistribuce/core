<?php

require_once __DIR__ . "/__bootstrap__.php";

class FacadeTest extends PHPUnit_Framework_TestCase
{

    private $container;

    protected function setUp()
    {
        $manager = new FooServiceManager();
        $manager->addService('foo', new FooService('manager:foo'));
        $manager->addService('baz', new FooService('manager:baz'));
        $manager->setDefault('baz');
        $this->container = new FooContainer([
            'foo' => new FooService( 'n:foo'),
            'bar' => new FooService('n:bar'),
            'manager' => $manager,
        ]);
        \Pilulka\Core\Facade::setFacadeContainer($this->container);
    }

    public function testDefaultMethodAccess()
    {
        $this->assertEquals(FooFacade::name(), 'n:foo');
    }

    public function testManagerDefaultAccess()
    {
        $this->assertEquals(ManagerFacade::name(), 'manager:baz');
    }

    public function testManagerSpecificInstanceAccess()
    {
        $this->assertEquals(
            ManagerFacade::instance('foo')->name(),
            'manager:foo'
        );
    }

}