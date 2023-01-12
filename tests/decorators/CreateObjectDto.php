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

    public function validate()
    {
        return [
            'dtoId' => function ($value) {
                return $value >= 0;
            },
            'dtoName' => function ($value) {
                return true;
            },
            'dtoCaption' => function ($value) {
                return true;
            },
        ];
    }
}