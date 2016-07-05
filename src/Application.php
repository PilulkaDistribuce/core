<?php

namespace Pilulka\Core;

use Pilulka\Core\Contracts\Container;
use Pilulka\Core\Facades\Parameters;

class Application
{

    private $container;

    private function __construct(Container $container)
    {
        $this->container = $container;
        $this->init();
    }

    public function init()
    {
        Facade::setFacadeContainer($this->getContainer());
        $this->registerFacades();
    }

    private function registerFacades()
    {
        foreach ($this->getFacadeArray() as $alias=>$original) {
            //TODO: check if given original is child of Pilulka\Core\Facade
            class_alias($original, $alias);
        }
    }

    private function getFacadeArray()
    {
        return $this->getSystemFacades() + Parameters::get('facades');
    }

    private function getSystemFacades()
    {
        return [
            'Container' => \Pilulka\Core\Facades\Container::class,
            'Parameters' => Parameters::class,
        ];
    }

    /**
     * @return Container
     */
    public function getContainer()
    {
        return $this->container;
    }

    public static function boot(Container &$container)
    {
        return new self($container);
    }

}