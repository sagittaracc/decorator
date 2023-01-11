<?php

namespace Sagittaracc\PhpPythonDecorator\tests\classes;

use Sagittaracc\PhpPythonDecorator\Decorator\Decorator;
use Sagittaracc\PhpPythonDecorator\tests\decorators\ObjectDto;

class Data
{
    use Decorator;

    #[ObjectDto]
    protected function getData()
    {
        return [
            'id'      => 1,
            'name'    => 'name',
            'caption' => 'caption',
        ];
    }
}