<?php

namespace Sagittaracc\PhpPythonDecorator\tests\di\service;

use Sagittaracc\PhpPythonDecorator\tests\di\container\Container;

class StoreService
{
    use Container;

    public function getStoreCoordinates() {
        return $this->_geolocationService->getCoordinatesFromAddress();
    }
}