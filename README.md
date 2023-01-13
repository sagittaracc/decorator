# PHP Python Decorator
Python style decorators for PHP

# Example
```php

use Sagittaracc\PhpPythonDecorator\Decorator;
use Sagittaracc\PhpPythonDecorator\PythonObject;

class Calc extends PythonObject
{
    use Decorator;

    #[Timer]
    function _sum($a, $b)
    {
        sleep(1);
        return $a + $b;
    }
}
```

`Timer` decorator calculates how long it takes to execute the function

```php

use Sagittaracc\PhpPythonDecorator\PythonDecorator;

#[Attribute]
class Timer extends PythonDecorator
{
    public function main($func, ...$args)
    {
        $time_start = microtime(true);

        $result = $func($args);

        $time_end = microtime(true);

        return sprintf(
            "Total execution: %f; Result: %d",
            $time_end - $time_start,
            $result
        );
    }
}
```

This is how you call the decorated method

```php

$calc = new Calc();
echo $calc->sum(1, 2); // Total execution: 1.012572; Result: 3

```

## *** Important
All the methods that will be decorated should start with the `_` prefix but be called without `_`
