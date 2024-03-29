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

# Validation
```php

use Sagittaracc\PhpPythonDecorator\Decorator;
use Sagittaracc\PhpPythonDecorator\tests\examples\Progress;
use Sagittaracc\PhpPythonDecorator\tests\validators\Length;
use Sagittaracc\PhpPythonDecorator\tests\validators\SerializeOf;
use Sagittaracc\PhpPythonDecorator\tests\validators\In;
use Sagittaracc\PhpPythonDecorator\tests\validators\LessThan;
use Sagittaracc\PhpPythonDecorator\tests\validators\UInt8;

class Request extends BaseRequest
{
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

    // Custom validator
    #[Table]
    public array $table;
}

/**
 * Usage
 */
new Request([
    'name' => 'my_table',
    'caption' => 'my_table_caption',
    'progress' => [
        'max' => 255,
        'pos' => 1,
        'status' => 'progress',
        'caption' => 'in progress...',
    ],
    'data' => [
        'header' => ['col-1', 'col-2'],
        'table' => [
            'ins' => [
                ['1', '2'],
                ['3', '4'],
                ['5', '6'],
            ]
        ],
    ]
]);
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
