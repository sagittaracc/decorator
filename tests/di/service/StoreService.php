<?php

namespace Sagittaracc\PhpPythonDecorator\tests\di\service;

use Sagittaracc\PhpPythonDecorator\Decorator;
use Sagittaracc\PhpPythonDecorator\tests\di\decorator\GeolocationService;

class StoreService
{
    use Decorator;

    #[GeolocationService]
    public $geolocationService;

    public function getStoreCoordinates() {
        return $this->_geolocationService->getCoordinatesFromAddress();
    }
}