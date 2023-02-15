<?php

namespace Sagittaracc\PhpPythonDecorator\tests\di\decorator;

use Attribute;

#[Attribute]
class GeolocationService
{
    public function getCoordinatesFromAddress()
    {
        return [33.333, 55.555];
    }
}