<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Attribute;
use Exception;
use Sagittaracc\PhpPythonDecorator\Decorator\DecoratorAttribute;

/**
 * Данный декоратор искусственно моделирует процесс успешных и не успешных попыток выполнения какой-либо функции
 * В данном случае "условно" считается что функция может выполниться только с определенного раза
 */

#[Attribute]
class Retry extends DecoratorAttribute
{
    function __construct(
        private int $maxAttemptCount
    ) {}

    public function main($func, ...$args)
    {
        $attemptTotal = 0;

        for ($i = 1; $i <= $this->maxAttemptCount; $i++) {
            try
            {
                $attemptTotal++;

                if ($i < 3) {
                    throw new Exception;
                }
                else {
                    $result = $func($args);
                }
            }
            catch (Exception $e)
            {
                $result = null;
            }
        }

        if ($result === null) {
            throw new Exception("{$this->maxAttemptCount} attempts was not enough!");
        }

        return [
            'attempts' => $attemptTotal,
            'result' => $result,
        ];
    }
}