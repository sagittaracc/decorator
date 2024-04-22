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
echo call_decorator_func_array([$calc, 'sum'], [1, 2]); // Total execution: 1.00034234 ms; Result: 3
```
Or inline
```php
$timerOnSum = (new Timer)->wrapper(fn($a, $b) => $calc->sum($a, $b));
echo $timerOnSum(1, 2); // Total execution: 1.00034234 ms; Result: 3
```

# Generics
```php
use Sagittaracc\PhpPythonDecorator\Decorator;
use Sagittaracc\PhpPythonDecorator\modules\generics\aliases\T;

#[T]
class PaymentInfo
{
    use Decorator;

    public string $id;

    public int $amount;

    #[T]
    public $currency;
}

$paymentInfo = new PaymentInfo();
$paymentInfo(Number::class); // new PaymentInfo<Number>();
set_decorator_prop($paymentInfo, 'currency', 'rubles'); // throws a GenericError
```

# Validation
```php

use Sagittaracc\PhpPythonDecorator\Decorator;
use Sagittaracc\PhpPythonDecorator\tests\examples\Progress;
use Sagittaracc\PhpPythonDecorator\tests\validators\Length;
use Sagittaracc\PhpPythonDecorator\tests\validators\SerializeOf;
use Sagittaracc\PhpPythonDecorator\tests\validators\In;
use Sagittaracc\PhpPythonDecorator\tests\validators\LessThan;
use Sagittaracc\PhpPythonDecorator\tests\validators\UInt8;

class Progress
{
    use Decorator;

    #[UInt8]
    public $max;

    #[UInt8]
    #[LessThan('max')]
    public $pos;

    #[In('progress', 'finish', 'aborted')]
    public $status;

    #[Length(32)]
    public string $caption;
}

$progress = new Progress();

set_decorator_prop($progress, 'max', 255);  // max uint8 - 255
set_decorator_prop($progress, 'pos', 100);  // should be less than max
set_decorator_prop($progress, 'status', 'progress');  // status is one of possible cases (progress, finish or aborted)
set_decorator_prop($progress, 'caption', 'in progress ...');  // just a string (max length is 32)
```

# Router
```php
class Controller
{
    use Decorator;

    #[Route('/hello')]
    #[Route('/hello/(\w+)')]
    function greetingPerson($name = 'guest')
    {
        return "Hello, $name";
    }
}

// index.php
(new Route('/hello/Yuriy'))->getMethod(Controller::class)->run();  // output: Hello, Yuriy
```

# Console
```php
use Sagittaracc\PhpPythonDecorator\Decorator;
use Sagittaracc\PhpPythonDecorator\modules\console\core\Console;

class Controller
{
    use Decorator;

    #[Console('hello')]
    function greetingPerson($name)
    {
        return "Hello, $name";
    }
}
```

in the command line it would be calling for example something like this:

`php index.php -c hello --name Yuriy`

then in `index.php` you should read the command and the parameters and after that call it like this:

```php
(new Console('hello'))->setParameters(['name' => 'Yuriy'])->getMethod(Controller::class)->run();
```