<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators\Dto;

abstract class DtoDecorator
{
    public function main($func, ...$args)
    {
        $row = $func($args);

        $dtoFields = array_flip($this->props());

        foreach ($row as $key => $value) {
            if (isset($dtoFields[$key])) {
                $this->{$dtoFields[$key]} = $value;
            }
        }

        return $this;
    }

    abstract public function props();
}