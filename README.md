# PHP Python Decorator
Python style decorators for PHP

# Requirements
PHP 8.1 or higher

# Install
`composer require sagittaracc/php-python-decorator`

# Example
How long it takes to run a method. See the [`Timer`](https://github.com/sagittaracc/php-python-decorator/blob/main/tests/decorators/Timer.php) decorator
```php

use Sagittaracc\PhpPythonDecorator\Decorator;

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
This is how you can call it
```php
$calc = new Calc();
echo $calc->_sum(1, 2); // Total execution: 1.00034234 ms; Result: 3
```

# Validation
```php

use Sagittaracc\PhpPythonDecorator\Decorator;

class Request
{
    use Decorator;

    #[Int8]
    public $id;

    #[UInt8]
    public $uid;

    #[Str]
    #[Length(5)]
    public $method;

    #[ArrayOf(UInt8::class)]
    public array $params;

    #[SerializeOf(User::class)]
    public array $user;

    #[SerializeArrayOf(User::class)]
    public array $userList;
}
```