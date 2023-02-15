<?php

namespace Sagittaracc\PhpPythonDecorator\tests\di\decorator;

use Attribute;
use Sagittaracc\PhpPythonDecorator\tests\di\interface\GeolocationServiceInterface;

#[Attribute]
class GeolocationService implements GeolocationServiceInterface
{
    public function getCoordinatesFromAddress()
    {
        return [33.333, 55.555];
    }
}