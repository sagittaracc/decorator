<?php

namespace Sagittaracc\PhpPythonDecorator\tests\classes;

use Sagittaracc\PhpPythonDecorator\Decorator;
use Sagittaracc\PhpPythonDecorator\tests\decorators\CreateObjectDto;
use Sagittaracc\PhpPythonDecorator\tests\decorators\CreateRoleListDto;
use Sagittaracc\PhpPythonDecorator\tests\decorators\CreateUserListDto;

class Data
{
    use Decorator;

    #[CreateObjectDto]
    protected function getData()
    {
        return [
            'id'      => 1,
            'name'    => 'name',
            'caption' => 'caption',
        ];
    }
    
    #[CreateObjectDto]
    protected function getFailData()
    {
        return [
            'id'            => 1,
            'name'          => 'name',
            'wrong_caption' => 'caption',
        ];
    }

    #[CreateObjectDto]
    protected function getUnvalidData()
    {
        return [
            'id'      => 'unvalid_id',
            'name'    => 'name',
            'caption' => 'caption',
        ];
    }

    #[CreateObjectDto]
    protected function getUnvalidDataOverCustomValidation()
    {
        return [
            'id'      => -1,
            'name'    => 'name',
            'caption' => 'caption',
        ];
    }

    #[CreateUserListDto]
    protected function getUserList()
    {
        return [
            'users' => ['me', 'friend'],
            'roles' => $this->run('getRoleList'),
        ];
    }

    #[CreateRoleListDto]
    protected function getRoleList()
    {
        return [
            'list' => ['guest', 'user', 'admin']
        ];
    }
}