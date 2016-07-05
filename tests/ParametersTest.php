<?php

require_once __DIR__ . "/__bootstrap__.php";

use Pilulka\Core\Facades\Parameters;

class ParametersTest extends PHPUnit_Framework_TestCase
{

    public function testBasicAccess()
    {
        $this->assertTrue(
            is_array(Parameters::get('facades')),
            'Key `facades` have to be array.'
        );
    }

    public function testParamDotAccess()
    {
        $this->assertEquals(
            FooService::class,
            Parameters::get('facades.Foo')
        );
    }
    
}