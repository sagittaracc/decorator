<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\tests\decorators\Dto\DtoDecorator;

#[Attribute]
class CreateListDto extends DtoDecorator
{
    public int $id;

    public CreateItemsDto $items;

    public function props()
    {
        return [
            'id' => '_id',
            'items' => '_items',
        ];
    }

    public function validate()
    {
        return [];
    }
}