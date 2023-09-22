<?php

function call_decorator_func_array(callable $callback, array $args): mixed
{
    $object = $callback[0];
    $method = get_decor_name($callback[1]);

    return call_user_func_array([$object, $method], $args);
}