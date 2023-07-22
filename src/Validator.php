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

    public function wrapper($value)
    {
        $this->errors = [];
        
        if ($this->validation($value)) {
            return;
        }

        if ($this->debug) {
            throw new Exception($this->dumpErrors());
        }
    }

    public function addError($error)
    {
        $this->errors[] = [
            'class' => get_class($this->getObject()),
            'property' => $this->getPropertyOrMethod(),
            'message' => $error,
        ];
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function dumpErrors()
    {
        $errors = [];
        foreach ($this->getErrors() as $error) {
            $errors[] = "{$error['class']}:{$error['property']} -> {$error['message']}";
        }
        return implode("\n", $errors);
    }
    
    abstract public function validation($value);
}