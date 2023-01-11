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
        $attemptsNeeded = 1;

        for ($i = 1; $i <= $this->attempts; $i++) {
            try
            {
                if ($i < 3) {
                    throw new Exception;
                }
                else {
                    $result = $func($args);
                    $attemptsNeeded = $i;
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
            'attempts' => $attemptsNeeded,
            'result' => $result,
        ];
    }
}