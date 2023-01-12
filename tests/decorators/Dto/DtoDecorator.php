<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators\Dto;

use Sagittaracc\PhpPythonDecorator\Decorator\DecoratorAttribute;
use Sagittaracc\PhpPythonDecorator\tests\exceptions\DtoException;
use Sagittaracc\PhpPythonDecorator\tests\exceptions\DtoTypeError;
use Sagittaracc\PhpPythonDecorator\tests\exceptions\DtoValidationError;
use TypeError;

abstract class DtoDecorator extends DecoratorAttribute
{
    public function main($func, ...$args)
    {
        $row = $func($args);

        $dtoFields = $this->props();
        $validateList = $this->validate();

        foreach ($dtoFields as $dtoField => $field) {
            if (isset($row[$field])) {
                try
                {
                    $this->$dtoField = $row[$field];
                    if ($validateList[$dtoField]($this->$dtoField) === false) {
                        throw new DtoValidationError;
                    }
                }
                catch (TypeError $e)
                {
                    throw new DtoTypeError;
                }
            }
            else {
                throw new DtoException(
                    sprintf(
                        "%s::$%s can not be set because in method %s::%s() property `%s` was not returned!",
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

    abstract public function validate();
}