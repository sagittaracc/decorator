<?php

namespace Sagittaracc\PhpPythonDecorator\tests\service;

use Sagittaracc\PhpPythonDecorator\Decorator;
use Sagittaracc\PhpPythonDecorator\tests\service\geo\GeolocationService;
use Sagittaracc\PhpPythonDecorator\tests\service\geo\GeolocationServiceInterface;

class StoreService
{
    use Decorator;

    #[GeolocationService]
    private GeolocationServiceInterface $geolocationService;

    public function getStoreCoordinates() {
        return $this->_geolocationService->getCoordinatesFromAddress();
    }
}