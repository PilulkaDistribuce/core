<?php

namespace Pilulka\Core\Facades;

use Pilulka\Core\Facade;

class Parameters extends Facade
{
    protected static function resolveInstance()
    {
        return new \Pilulka\Core\Parameters(parent::resolveInstance());
    }


    public static function getFacadeAccessor()
    {
        return 'parameters';
    }

}