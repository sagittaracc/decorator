<?php

namespace Sagittaracc\PhpPythonDecorator\tests\di;

use Sagittaracc\PhpPythonDecorator\Decorator;
use Sagittaracc\PhpPythonDecorator\tests\services\geo\GeolocationService;
use Sagittaracc\PhpPythonDecorator\tests\services\geo\GeolocationServiceInterface;
use Sagittaracc\PhpPythonDecorator\tests\services\proxy\Proxy;
use Sagittaracc\PhpPythonDecorator\tests\services\proxy\ProxyInterface;

trait Container
{
    use Decorator;

    #[GeolocationService]
    private GeolocationServiceInterface $geolocationService;

    #[Di(GeolocationService::class)]
    private GeolocationServiceInterface $geolocationService1;

    #[Di(Proxy::class)]
    private ProxyInterface $proxy;
}