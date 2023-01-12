<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\tests\decorators\Dto\DtoDecorator;

#[Attribute]
class CreateRoleListDto extends DtoDecorator
{
    public array $list;

    public function props()
    {
        return [
            'list' => 'list',
        ];
    }

    public function validate()
    {
        return [];
    }
}