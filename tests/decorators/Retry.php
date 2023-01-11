<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Attribute;
use Exception;

/**
 * Данный декоратор искусственно моделирует процесс успешных и не успешных попыток выполнения какой-либо функции
 * В данном случае "условно" считается что функция может выполниться только с определенного раза
 */

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
        $attemptNeeded = 1;

        for ($attempt = 1; $attempt <= $this->attempts; $attempt++) {
            try
            {
                if ($attempt < 3) {
                    throw new Exception;
                }
                else {
                    $result = $func($args);
                    $attemptNeeded = $attempt;
                }
            }
            catch (Exception $e)
            {
                $result = null;
            }
        }

        if ($result === null) {
            throw new Exception("{$this->attempts} attempts was not enough!");
        }

        return [
            'attempts' => $attemptNeeded,
            'result' => $result,
        ];
    }
}