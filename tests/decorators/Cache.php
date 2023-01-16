<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

#[Attribute]
final class Cache extends PythonDecorator
{
    public function main($func, ...$args)
    {
        if ($cache = $this->getCache($this->method)) {
            // return $cache
            return 'cache';
        }

        $result = $func($args);
        $this->setCache($this->method, $result);

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