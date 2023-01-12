<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators\Dto;

use Exception;

abstract class DtoDecorator
{
    public function main($func, ...$args)
    {
        $row = $func($args);

        $dtoFields = $this->props();

        foreach ($dtoFields as $dtoField => $field) {
            if (isset($row[$field])) {
                $this->$dtoField = $row[$field];
            }
            else {
                throw new Exception("'\${$dtoField}' can not be set because '\${$field}' is not defined!");
            }
        }

        return $this;
    }

    abstract public function props();
}