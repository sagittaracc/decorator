<?php

function get_real_name($name)
{
    return trim($name, '_');
}

function get_decor_name($name)
{
    return '_' . $name . '_';
}