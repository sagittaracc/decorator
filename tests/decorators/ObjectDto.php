<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\Decorator\Dto\DtoDecorator;

#[Attribute]
class ObjectDto extends DtoDecorator {

    public function fields()
    {
        return [
            'id'      => 'dtoId',
            'name'    => 'dtoName',
            'caption' => 'dtoCaption',
        ];
    }
}