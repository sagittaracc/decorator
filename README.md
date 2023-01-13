# PHP Python Decorator
Python style decorators for PHP

# Install
`composer require sagittaracc/php-python-decorator`

# Requirements
PHP >= 8

# Example
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
echo $calc->_sum(1, 2); // Total execution: 1.012572; Result: 3

```

## *** Important
To make a method apply its decorators you have to call this method with the `_` prefix
