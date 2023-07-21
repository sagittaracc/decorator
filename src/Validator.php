<?php

namespace Sagittaracc\PhpPythonDecorator;

use Exception;
use sagittaracc\PlaceholderHelper;

/**
 * @author Yuriy Arutyunyan <sagittaracc@gmail.com>
 */
abstract class Validator extends PythonDecorator
{
    public $debug = true;
    protected $details;

    public function addDetail($detail)
    {
        $this->details[] = $detail;
    }

    public function getDetails()
    {
        return $this->details;
    }

    public function getTmp()
    {
        return get_class($this->getObject()) . ':' . $this->getPropertyOrMethod();
    }

    public function wrapper($closure)
    {
        [$object, $property, $value] = $closure();

        $this->details = [];
        
        if ($this->validation($value)) {
            return;
        }

        $class = get_class($object);

        if ($this->debug) {
            throw new Exception(
                (new PlaceholderHelper("?"))->bind($this->getDetails())
            );
        }
    }
    
    abstract public function validation($value);

    public function __toString()
    {
        return (new \ReflectionClass($this))->getShortName();
    }
}