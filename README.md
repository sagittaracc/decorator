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
use Sagittaracc\PhpPythonDecorator\tests\examples\Progress;
use Sagittaracc\PhpPythonDecorator\tests\validators\Length;
use Sagittaracc\PhpPythonDecorator\tests\validators\SerializeOf;
use Sagittaracc\PhpPythonDecorator\tests\validators\In;
use Sagittaracc\PhpPythonDecorator\tests\validators\LessThan;
use Sagittaracc\PhpPythonDecorator\tests\validators\UInt8;

class Request
{
    use Decorator;

    #[Length(8)]
    public string $name;

    #[Length(32)]
    public string $caption;

    #[SerializeOf(Progress::class)]
    public array $progress;

    #[SerializeOf(DataTable::class)]
    public array $data;
}

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

class DataTable
{
    use Decorator;

    #[ArrayOf(Str::class)]
    public array $header;

    public array $table;
}
```

# Attributes
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
```
