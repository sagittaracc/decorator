<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators\Dto;

abstract class DtoDecorator
{
    public function main($func, ...$args)
    {
        $row = $func($args);

        $dtoFields = $this->props();

        foreach ($row as $key => $value) {
            $this->{$dtoFields[$key]} = $value;
        }

        return $this;
    }

    abstract public function props();
}