# php-python-decorator
Python style decorators for PHP

# Example
```php

use Sagittaracc\PhpPythonDecorator\Decorator;
use Sagittaracc\PhpPythonDecorator\PythonObject;

class Calc extends PythonObject
{
    use Decorator;  // <-- comment this line out to not apply the decorators

    #[Timer]
    #[Log]
    function _sum($a, $b)
    {
        sleep(1);
        return $a + $b;
    }
}
```
`Timer` decorator calculates how much it takes to execute the function
```php

#[Attribute]
class Timer extends \Sagittaracc\PhpPythonDecorator\Attribute
{
    public function main($func, ...$args)
    {
        $time_start = microtime(true);

        $result = $func($args);

        $time_end = microtime(true);
        $execution_time = $time_end - $time_start;

        return "Total execution: $execution_time; Result: $result";
    }
}
```
`Log` decorator prints the output
```php

#[Attribute]
class Log extends \Sagittaracc\PhpPythonDecorator\Attribute
{
    public function main($func, ...$args)
    {
        echo $func();
    }
}
```
This is how you call the decorated method
```php

$calc = new Calc();
$calc->sum(1, 2); // Total execution: 1.00000343; Result: 3

```
