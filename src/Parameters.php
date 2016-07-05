<?php

namespace Pilulka\Core;

use Pilulka\Core\Exception\Exception;

class Parameters
{

    private $parameters;

    /**
     * @param array $parameters
     */
    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }

    public function get($paramPath) {
        $params = $this->parameters;
        $path = explode('.', $paramPath);
        $value = null;
        foreach ($path as $key) {
            if(isset($params[$key])) {
                $value = $params[$key];
                $params = $value;
            } else {
                throw new Exception(
                    "Undefined parameters path: `{$paramPath}`."
                );
            }
        }
        return $value;
    }


}