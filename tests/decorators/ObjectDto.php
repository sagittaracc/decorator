<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Attribute;

#[Attribute]
class ObjectDto {
    public function main($func, ...$args)
    {
        $row = $func($args);

        $dto = [];
        $dtoFields = $this->fields();

        foreach ($row as $key => $value) {
            $dto[$dtoFields[$key]] = $value;
        }

        return $dto;
    }

    private function fields()
    {
        return [
            'id'      => 'dtoId',
            'name'    => 'dtoName',
            'caption' => 'dtoCaption',
        ];
    }
}