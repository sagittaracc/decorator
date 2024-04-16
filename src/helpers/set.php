<?php

function set_decorator_prop($object, $prop, $value)
{
    $prop = get_decor_name($prop);
    $object->$prop = $value;
}