<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators\Dto;

use Closure;
use Sagittaracc\PhpPythonDecorator\Decorator;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;
use Sagittaracc\PhpPythonDecorator\tests\exceptions\DtoException;
use Sagittaracc\PhpPythonDecorator\tests\exceptions\DtoTypeError;
use TypeError;

abstract class DtoDecorator extends PythonDecorator
{
    use Decorator;

    public function wrapper(mixed $callback)
    {
        return function (...$args) use ($callback) {
            $row = call_user_func_array($callback, $args);
    
            $dtoFields = $this->props();
            $validateList = $this->validate();
    
            foreach ($dtoFields as $dtoField => $field) {
                if (isset($row[$field])) {
                    try
                    {
                        $this->$dtoField = $row[$field];
    
                        if (isset($validateList[$dtoField]) && $validateList[$dtoField] instanceof Closure) {
                            $validateList[$dtoField]($this->$dtoField);
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
                            get_class($this->getObject()),
                            $this->getPropertyOrMethod(),
                            $field
                        )
                    );
                }
            }
    
            return $this;
        };
    }

    abstract public function props();

    public function validate()
    {
        return [];
    }
}