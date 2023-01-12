<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\tests\decorators\Dto\DtoDecorator;
use Sagittaracc\PhpPythonDecorator\tests\exceptions\DtoValidationError;

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
                if ($value < 0) {
                    throw new DtoValidationError('CreateObjectDto::$dtoId should be positive!');
                }
            },
        ];
    }
}