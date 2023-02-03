# PHP Python Decorator
Python style decorators for PHP

# Requirements
PHP >= 8

# Install
`composer require sagittaracc/php-python-decorator`

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
### This is how you call it
```php
$calc = new Calc();
// using the decorators
$calc->_sum(1, 2); // Total execution: 1.00034234 ms; Result: 3
// not using any decorators
$calc->sum(1, 2); // 3
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
### This is how you call a `Route` inside your `router`
```php
(new Route('/hello'))->runIn(Controller::class)
```
