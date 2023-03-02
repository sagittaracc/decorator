<?php

namespace Sagittaracc\PhpPythonDecorator\tests\attributes;

use Attribute;
use Sagittaracc\PhpPythonDecorator\PhpAttribute;

#[Attribute]
final class Route extends PhpAttribute
{
    function __construct(
        private string $url,
        private string $method = 'GET'
    ) {}

    protected function matchTo($object): array|false
    {
        if (preg_match("`^$this->url$`", $object->url, $matches)
         && $this->method === $object->method) {
            array_shift($matches);
            return $matches;
        }

        return false;
    }

    public function __toString()
    {
        return "{$this->method} {$this->url}" . parent::__toString();
    }
}