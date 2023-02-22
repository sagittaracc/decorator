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
    public GeolocationServiceInterface $geolocationService;

    #[Di(GeolocationService::class)]
    public GeolocationServiceInterface $geolocationService1;

    #[Di(Proxy::class)]
    public ProxyInterface $proxy;
}