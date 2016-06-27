<?php

namespace Pilulka\Core;

use Pilulka\Core\Exception\ServiceManagerException as Exception;

abstract class ServiceManager
{

    protected $services = [];
    protected $defaultKey;

    public function setDefault($default)
    {
        $this->protectDefault();
        $this->defaultKey = $default;
    }

    public function addService($name, $service)
    {
        $this->checkIfIsAlreadySet($name);
        $this->services[$name] = $service;
    }

    public function instance($name=null)
    {
        if(is_null($name)) {
            return $this->getDefaultService();
        }
        if(!$this->serviceIsDefined($name)) {
            throw new Exception(
                "Service with name: `{$name}`" .
                " is not defined."
            );
        }
        return $this->services[$name];
    }

    public function __call($method, $parameters)
    {

        return call_user_func_array([$this->instance(), $method], $parameters);
    }

    private function checkIfIsAlreadySet($name)
    {
        if($this->serviceIsDefined($name)) {
            throw new Exception(
                "Service instance with key: `{$name}` " .
                "is already defined in manager."
            );
        }
    }

    private function getDefaultService()
    {
        if(!isset($this->defaultKey)) {
            throw new Exception("Default service is not defined.");
        }
        return $this->instance($this->defaultKey);
    }

    private function serviceIsDefined($name)
    {
        return array_key_exists($name, $this->services);
    }

    private function protectDefault()
    {
        if (isset($this->defaultKey)) {
            throw new Exception('Default service is already defined.');
        }
    }

}
