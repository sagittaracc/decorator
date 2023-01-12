<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators\Dto;

use Sagittaracc\PhpPythonDecorator\Decorator\DecoratorAttribute;
use Sagittaracc\PhpPythonDecorator\tests\exceptions\DtoException;

abstract class DtoDecorator extends DecoratorAttribute
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
                throw new DtoException(
                    sprintf(
                        "%s::$%s can not be set because in method %s::%s() property $%s was not returned!",
                        get_class($this),
                        $dtoField,
                        $this->className,
                        $this->methodName,
                        $field
                    )
                );
            }
        }

        return $this;
    }

    abstract public function props();
}