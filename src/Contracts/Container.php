<?php


namespace Pilulka\Core\Contracts;


interface Container
{

    public function get($id);

    public function has($id);

}