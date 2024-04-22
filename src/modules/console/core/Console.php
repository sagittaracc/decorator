<?php

namespace Sagittaracc\PhpPythonDecorator\modules\console\core;

use Attribute;
use Sagittaracc\PhpPythonDecorator\PhpAttribute;

#[Attribute(Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
final class Console extends PhpAttribute
{
    private array $parameters;

    function __construct(
        private string $command,
    ) {}

    public function setParameters(array $parameters)
    {
        $this->parameters = $parameters;

        return $this;
    }

    protected function matchTo($object): array|false
    {
        /**
         * @var Console $object
         */
        if ($this->command === $object->command) {
            return $object->parameters ?? [];
        }

        return false;
    }
}