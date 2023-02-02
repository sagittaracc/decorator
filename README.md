# PHP Python Decorator
Python style decorators for PHP

# Install
`composer require sagittaracc/php-python-decorator`

# Requirements
PHP >= 8

# Examples
### Calc how long it takes to run a method. See the [`Timer`](https://github.com/sagittaracc/php-python-decorator/blob/main/tests/decorators/Timer.php) decorator
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
### This is how you can do a simple `Router` implementation. See the [`Route`](https://github.com/sagittaracc/php-python-decorator/blob/main/tests/decorators/Route.php) decorator
```php
namespace Sagittaracc\PhpPythonDecorator\tests\examples;

use Sagittaracc\PhpPythonDecorator\Decorator;
use Sagittaracc\PhpPythonDecorator\tests\decorators\Route;

class Controller
{
    use Decorator;

    #[Route('/hello')]
    function greetings()
    {
        return "Hello world!";
    }

    #[Route('/hello/(\w+)')]
    function greetingPerson($name)
    {
        return "Hello, $name";
    }
}
```
