<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

#[Attribute]
final class Cache extends PythonDecorator
{
    public function wrapper($func)
    {
        if ($cache = $this->getCache($this->getPropertyOrMethod())) {
            // return $cache
            return 'cache';
        }

        $result = $func();
        $this->setCache($this->getPropertyOrMethod(), $result);

        return $result;
    }

    private function getCache($key)
    {
        return $this->getObject()->scope['cache'][$key] ?? null;
    }

    private function setCache($key, $value)
    {
        $this->getObject()->scope['cache'][$key] = $value;
    }
}