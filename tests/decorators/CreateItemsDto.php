<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\tests\decorators\Dto\DtoDecorator;

#[Attribute]
class CreateItemsDto extends DtoDecorator
{
    public array $list;

    public function props()
    {
        return [
            'list' => '_list',
        ];
    }
}