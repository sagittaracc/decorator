<?php

namespace Sagittaracc\PhpPythonDecorator\Decorator\Dto;

abstract class DtoDecorator
{
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

    abstract public function fields();
}