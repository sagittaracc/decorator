<?php

namespace Sagittaracc\PhpPythonDecorator\tests\di\service\geo;

use Attribute;

#[Attribute]
class GeolocationService implements GeolocationServiceInterface
{
    public function getCoordinatesFromAddress()
    {
        return [33.333, 55.555];
    }
}