<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Attribute;
use DivisionByZeroError;
use Exception;

#[Attribute]
class Retry
{
    private int $attempts;

    function __construct(int $attempts)
    {
        $this->attempts = $attempts;
    }

    public function main($func, ...$args)
    {
        for ($attempt = 1; $attempt <= $this->attempts; $attempt++) {
            try
            {
                $result = $func($args);
                break;
            }
            catch (DivisionByZeroError $e)
            {
                $result = null;
            }
        }

        if ($result === null) {
            throw new Exception("{$this->attempts} attempts was not enough!");
        }

        return [
            'attempts' => $attempt,
            'result' => $result,
        ];
    }
}