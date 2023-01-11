<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\tests\decorators\Dto\DtoDecorator;

#[Attribute]
class ObjectDto extends DtoDecorator {

    public $dtoId;
    public $dtoName;
    public $dtoCaption;

    public function fields()
    {
        return [
            'id'      => 'dtoId',
            'name'    => 'dtoName',
            'caption' => 'dtoCaption',
        ];
    }
}