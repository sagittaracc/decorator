<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\tests\decorators\Dto\DtoDecorator;

#[Attribute]
class CreateUserListDto extends DtoDecorator
{
    public array $list;

    public CreateRoleListDto $roles;

    public function props()
    {
        return [
            'list' => 'users',
            'roles' => 'roles',
        ];
    }

    public function validate()
    {
        return [];
    }
}