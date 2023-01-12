<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\tests\decorators\Dto\DtoDecorator;

#[Attribute]
class CreateObjectDto extends DtoDecorator
{
    public int $dtoId;
    public string $dtoName;
    public string $dtoCaption;

    public function props()
    {
        return [
            'dtoId'      => 'id',
            'dtoName'    => 'name',
            'dtoCaption' => 'caption',
        ];
    }
}