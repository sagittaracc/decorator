# php-python-decorator
Python style decorator for PHP

# Example
```php

use Sagittaracc\PhpPythonDecorator\Decorator\Decorator;

class Calc
{
    use Decorator;

    #[Timer]
    public function sum1($a, $b)
    {
        sleep(1);
        return $a + $b;
    }

    public function sum2($a, $b)
    {
        return $a + $b;
    }
}
```

```php

#[Attribute]
class Timer {
    public function main($callback)
    {
        $time_start = microtime(true);

        $result = $callback();

        $time_end = microtime(true);
        $execution_time = $time_end - $time_start;

        return "Total execution: $execution_time; Result: $result";
    }
}
```

```php

$calc = new Calc();
echo $calc->run('sum1', 1, 2); // Total execution: 1.00000343; Result: 3
echo $calc->run('sum2', 1, 2); // 3

```
