<?php

require_once __DIR__ . "/../vendor/autoload.php";

class FooServiceManager extends \Pilulka\Core\ServiceManager {}
class FooService {

    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function name()
    {
        return $this->name;
    }

}
class EmptyServiceManager extends \Pilulka\Core\ServiceManager {}
class FooContainer implements \Pilulka\Core\Contracts\Container {

    private $array = [];

    public function __construct(array $array)
    {
        $this->array = $array;
    }
    public function get($id)
    {
        return $this->array[$id];
    }

    public function has($id)
    {
        return array_key_exists($id, $this->array);
    }

}
class FooFacade extends \Pilulka\Core\Facade {

    public static function getFacadeAccessor()
    {
        return 'foo';
    }

}
class ManagerFacade extends \Pilulka\Core\Facade {

    public static function getFacadeAccessor()
    {
        return 'manager';
    }

}
