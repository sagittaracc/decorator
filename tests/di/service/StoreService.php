<?php

namespace Sagittaracc\PhpPythonDecorator\tests\di\service;

use Sagittaracc\PhpPythonDecorator\Decorator;
use Sagittaracc\PhpPythonDecorator\tests\di\decorator\GeolocationService;
use Sagittaracc\PhpPythonDecorator\tests\di\interface\GeolocationServiceInterface;

class StoreService
{
    use Decorator;

    #[GeolocationService]
    private GeolocationServiceInterface $geolocationService;

    public function getStoreCoordinates() {
        return $this->_geolocationService->getCoordinatesFromAddress();
    }
}