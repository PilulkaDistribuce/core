<?php

namespace Pilulka\Core;

use Pilulka\Core\Contracts\Container;

abstract class Facade
{

    /** @var Container */
    protected static $container;

    public static function __callStatic($name, $arguments)
    {
        return call_user_func_array(
            [static::resolveInstance(), $name],
            $arguments
        );
    }

    protected static function resolveInstance()
    {
        return static::$container->get(static::getFacadeAccessor());
    }

    public static function setFacadeContainer(Container $container)
    {
        static::$container = $container;
    }

    public static function getFacadeAccessor() {
        throw new \RuntimeException(
            'You must define Container key accessor in this method ' .
            'or implement that otherwise.'
        );
    }

}