<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators\Dto;

use ReflectionClass;
use Sagittaracc\PhpPythonDecorator\tests\exceptions\DtoException;

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
                $reflection = new ReflectionClass($this);
                $shortClassName = $reflection->getShortName();
                throw new DtoException(
                    sprintf(
                        "%s can not be set because %s is not defined!",
                        "$shortClassName::\$$dtoField",
                        "Data::\$$field"
                    )
                );
            }
        }

        return $this;
    }

    abstract public function props();
}