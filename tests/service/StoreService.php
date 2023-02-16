<?php

namespace Sagittaracc\PhpPythonDecorator\tests\service;

use Sagittaracc\PhpPythonDecorator\Decorator;
use Sagittaracc\PhpPythonDecorator\tests\service\geo\GeolocationService;
use Sagittaracc\PhpPythonDecorator\tests\service\geo\GeolocationServiceInterface;
use Sagittaracc\PhpPythonDecorator\tests\service\proxy\Proxy;
use Sagittaracc\PhpPythonDecorator\tests\service\proxy\ProxyInterface;

class StoreService
{
    use Decorator;

    #[GeolocationService]
    private GeolocationServiceInterface $geolocationService;

    #[Di(GeolocationService::class)]
    private GeolocationServiceInterface $geolocationService1;

    #[Di(Proxy::class)]
    private ProxyInterface $proxy;

    public function getStoreCoordinates() {
        return $this->_geolocationService->getCoordinatesFromAddress();
    }

    public function getStoreCoordinates1() {
        return $this->_geolocationService1->getCoordinatesFromAddress();
    }
}