<?php

namespace Sagittaracc\PhpPythonDecorator;

use Exception;
use sagittaracc\PlaceholderHelper;

/**
 * @author Yuriy Arutyunyan <sagittaracc@gmail.com>
 */
abstract class Validator extends PythonDecorator
{
    /**
     * @var bool в режиме дебаг выбрасывается исключение
     */
    public bool $debug = true;
    /**
     * @var array ошибки валидации
     */
    protected array $errors;

    public function wrapper($closure)
    {
        [$object, $property, $value] = $closure();

        $this->errors = [];
        
        if ($this->validation($value)) {
            return;
        }

        if ($this->debug) {
            throw new Exception(
                (new PlaceholderHelper("?"))->bind($this->getErrors())
            );
        }
    }

    public function addError($error)
    {
        $this->errors[] = $error;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function getTmp()
    {
        return get_class($this->getObject()) . ':' . $this->getPropertyOrMethod();
    }
    
    abstract public function validation($value);
}