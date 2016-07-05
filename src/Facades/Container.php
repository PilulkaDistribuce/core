<?php

namespace Pilulka\Core\Facades;

use Pilulka\Core\Facade;

class Container extends Facade
{

    protected static function resolveInstance()
    {
        return self::$container;
    }

}