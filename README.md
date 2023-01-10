# php-python-decorator
Python style decorator for PHP

# Пример
```php

use Sagittaracc\PhpPythonDecorator\Decorator\Decorator;

class Calc
{
    use Decorator;

    #[Timer]
    #[Log]
    public function sum($a, $b)
    {
        sleep(1);
        return $a + $b;
    }
}
```
Декоратор `Timer` вычисляет время выполнения функции
```php

#[Attribute]
class Timer {
    public function main($func, ...$args)
    {
        return function () use ($func, $args) {
            $time_start = microtime(true);

            $result = $func($args);

            $time_end = microtime(true);
            $execution_time = $time_end - $time_start;

            return "Total execution: $execution_time; Result: $result";
        };
    }
}
```
Декоратор `Log` выводит результат на экран
```php

#[Attribute]
class Log {
    public function main($func, ...$args)
    {
        return function () use ($func) {
            echo $func();
        };
    }
}
```
Вызов декорируемого метода
```php

$calc = new Calc();
echo $calc->sum(1, 2); // Total execution: 1.00000343; Result: 3

```
