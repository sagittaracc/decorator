<?php

namespace Sagittaracc\PhpPythonDecorator\tests\orm\decorator;

use Attribute;
use Exception;
use ReflectionClass;
use ReflectionProperty;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

#[Attribute]
class Serialize extends PythonDecorator
{
    function __construct(
        private string $classObject,
        private string $count
    ) {}

    public function wrapper($func)
    {
        $rows = $func();

        if ($this->count === 'many') {
            return $this->serializeMany($rows);
        }
        else if ($this->count === 'one') {
            return $this->serializeOne($rows[0]);
        }
        else {
            throw new Exception("Serialize method `{$this->count}` doesn't exist!");
        }
    }

    private function serializeMany(array $rows)
    {
        $_rows = [];

        foreach ($rows as $row) {
            $_rows[] = $this->serializeOne($row);
        }
        
        return $_rows;
    }

    private function serializeOne(array $row)
    {
        $object = new $this->classObject;

        $class = new ReflectionClass($this->classObject);
        $props = $class->getProperties(ReflectionProperty::IS_PUBLIC);
        foreach ($props as $prop) {
            if (isset($row[$prop->name])) {
                $object->{$prop->name} = $row[$prop->name];
            }
        }

        return $object;
    }
}