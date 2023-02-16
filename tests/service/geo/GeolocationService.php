<?php

namespace Sagittaracc\PhpPythonDecorator\tests\service\geo;

use Attribute;
use Sagittaracc\PhpPythonDecorator\tests\service\proxy\Proxy;
use Sagittaracc\PhpPythonDecorator\tests\service\proxy\ProxyInterface;

#[Attribute]
class GeolocationService implements GeolocationServiceInterface
{
    function __construct(Proxy $proxy)
    {
    }

    public function getCoordinatesFromAddress()
    {
        return [33.333, 55.555];
    }
}