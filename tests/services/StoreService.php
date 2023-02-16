<?php

namespace Sagittaracc\PhpPythonDecorator\tests\services;

use Sagittaracc\PhpPythonDecorator\tests\di\Container;

class StoreService
{
    use Container;

    public function getStoreCoordinates() {
        return $this->_geolocationService->getCoordinatesFromAddress();
    }

    public function getStoreCoordinates1() {
        return $this->_geolocationService1->getCoordinatesFromAddress();
    }
}