<?php

namespace Sagittaracc\PhpPythonDecorator\tests\di\container;

use Sagittaracc\PhpPythonDecorator\Decorator;
use Sagittaracc\PhpPythonDecorator\tests\di\Di;
use Sagittaracc\PhpPythonDecorator\tests\di\service\geo\GeolocationService;
use Sagittaracc\PhpPythonDecorator\tests\di\service\geo\GeolocationServiceInterface;

trait Container
{
    use Decorator;

    #[Di(GeolocationService::class)]
    private GeolocationServiceInterface $geolocationService;
}