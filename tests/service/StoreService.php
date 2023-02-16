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

    #[Di(GeolocationService::class)]
    private GeolocationServiceInterface $geolocationService1;

    public function getStoreCoordinates() {
        return $this->_geolocationService->getCoordinatesFromAddress();
    }

    public function getStoreCoordinates1() {
        return $this->_geolocationService1->getCoordinatesFromAddress();
    }
}