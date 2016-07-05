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

$manager = new FooServiceManager();
$manager->addService('foo', new FooService('manager:foo'));
$manager->addService('baz', new FooService('manager:baz'));
$manager->setDefault('baz');
$container = new FooContainer([
    'foo' => new FooService('n:foo'),
    'bar' => new FooService('n:bar'),
    'manager' => $manager,
    'parameters' => [
        'facades' => [
            'Foo' => FooService::class,
        ]
    ]
]);

\Pilulka\Core\Application::boot($container);
