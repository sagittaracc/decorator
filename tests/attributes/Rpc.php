<?php

namespace Sagittaracc\PhpPythonDecorator\tests\attributes;

use Attribute;
use Sagittaracc\PhpPythonDecorator\PhpAttribute;

#[Attribute]
final class Rpc extends PhpAttribute
{
    function __construct(
        private string $method,
        private array $params = []
    ) {}

    protected function equalTo($object): array|false
    {
        if ($this->method === $object->method) {
            return $object->params;
        }

        return false;
    }
}