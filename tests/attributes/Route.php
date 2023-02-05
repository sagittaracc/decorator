<?php

namespace Sagittaracc\PhpPythonDecorator\tests\attributes;

use Attribute;
use Sagittaracc\PhpPythonDecorator\PhpAttribute;
use Sagittaracc\PhpPythonDecorator\PhpAttributeInterface;

#[Attribute]
final class Route extends PhpAttribute
{
    function __construct(
        private string $url,
        private string $method = 'GET'
    ) {}

    protected function equalTo($object)
    {
        if (preg_match("`^$this->url$`", $object->url, $matches)
         && $this->method === $object->method) {
            array_shift($matches);
            return $matches;
        }

        return false;
    }
}