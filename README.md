# PHP Python Decorator
Python style decorators for PHP

# Requirements
PHP 8 or higher

# Install
`composer require sagittaracc/php-python-decorator`

# Example
Calc how long it takes to run a method. See the [`Timer`](https://github.com/sagittaracc/php-python-decorator/blob/main/tests/decorators/Timer.php) decorator
```php

use Sagittaracc\PhpPythonDecorator\Decorator;
use Sagittaracc\PhpPythonDecorator\tests\decorators\Timer;

class Calc
{
    use Decorator;

    #[Timer]
    function sum($a, $b)
    {
        sleep(1);
        return $a + $b;
    }
}
```
This is how you call it
```php
$calc = new Calc();

// using the decorators
$calc->_sum(1, 2); // Total execution: 1.00034234 ms; Result: 3

// not using any decorators
$calc->sum(1, 2); // 3
```
# Testing
This is how you can unit-test a decorator separately. See the [`Example`](https://github.com/sagittaracc/php-python-decorator/blob/main/tests/DecoratorTest.php)
