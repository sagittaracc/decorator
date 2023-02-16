<?php

namespace Sagittaracc\PhpPythonDecorator\tests\services\geo;

use Attribute;
use Sagittaracc\PhpPythonDecorator\tests\services\proxy\ProxyInterface;

#[Attribute]
class GeolocationService implements GeolocationServiceInterface
{
    function __construct(
        private ProxyInterface $proxy
    )
    {
    }

    public function getCoordinatesFromAddress()
    {
        if ($this->proxy->isAvailable()) {
            return [33.333, 55.555];
        }
    }
}