<?php

namespace Sagittaracc\PhpPythonDecorator\tests\classes;

use Sagittaracc\PhpPythonDecorator\Decorator\Decorator;
use Sagittaracc\PhpPythonDecorator\tests\decorators\CreateObjectDto;

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
}