# PHP Python Decorator
Python style decorators for PHP

# Install
`composer require sagittaracc/php-python-decorator`

# Requirements
PHP >= 8

# Examples
### Calc how long it takes to run a method
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
### This is how you can do a simple `Router` implementation
```php
namespace Sagittaracc\PhpPythonDecorator\tests\examples;

use Sagittaracc\PhpPythonDecorator\Decorator;
use Sagittaracc\PhpPythonDecorator\tests\decorators\Router;

class Controller
{
    use Decorator;

    #[Router('/hello')]
    function greetings()
    {
        return "Hello world!";
    }

    #[Router('/hello/(\w+)')]
    function greetingPerson($name)
    {
        return "Hello, $name";
    }
}
```
