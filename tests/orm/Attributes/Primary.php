<?php

namespace Sagittaracc\PhpPythonDecorator\tests\orm\Attributes;

use Attribute;
use Sagittaracc\PhpPythonDecorator\PhpAttribute;

#[Attribute]
class Primary extends PhpAttribute
{
    protected function equalTo(PhpAttribute $object): array|false
    {
        return [];
    }
}