<?php

namespace Sagittaracc\PhpPythonDecorator\tests\di\decorator;

use Attribute;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

#[Attribute]
class GeolocationService  extends PythonDecorator
{
    public function wrapper($func, $args) {}

    public function getCoordinatesFromAddress()
    {
        return [33.333, 55.555];
    }
}