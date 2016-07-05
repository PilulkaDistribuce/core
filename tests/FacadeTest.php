<?php

require_once __DIR__ . "/__bootstrap__.php";

class FacadeTest extends PHPUnit_Framework_TestCase
{

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