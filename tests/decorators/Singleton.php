<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

class SingletonObject
{
    function __construct(
        private int $mult
    ) {}

    public function doSomething($data)
    {
        return $data * $this->mult;
    }
}

#[Attribute]
class Singleton extends PythonDecorator
{
    private static $instance;

    function __construct(
        private int $mult,
        private bool $needSingleton = true
    ) {}

    public function wrapper($func)
    {
        if ($this->needSingleton) {
            if (self::$instance === null) {
                self::$instance = new SingletonObject($this->mult);
            }
        }
        else {
            self::$instance = new SingletonObject($this->mult);
        }

        $result = $func();
        return self::$instance->doSomething($result);
    }
}