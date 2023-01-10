# php-python-decorator
Python style decorator for PHP

# Пример
Функцию `sum1` помечаем декоратором `Timer` чтобы подсчитать время выполнения функции, а функцию `sum2` без декоратора - чтобы просто получить результат
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

Пишем код декоратора (функция обернутая в декоратор вызывается как `$callback()`
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

// Так как функция sum1 обернута в декоратор Timer - на выходе мы получаем результат и время выполнения
echo $calc->run('sum1', 1, 2); // Total execution: 1.00000343; Result: 3

// Так как функция sum2 НЕ обернута в декоратор Timer - мы получаем просто результат
echo $calc->run('sum2', 1, 2); // 3

```
