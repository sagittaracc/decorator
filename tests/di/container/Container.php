<?php

namespace Sagittaracc\PhpPythonDecorator\tests\di\container;

use Sagittaracc\PhpPythonDecorator\Decorator;
use Sagittaracc\PhpPythonDecorator\tests\di\service\geo\GeolocationService;
use Sagittaracc\PhpPythonDecorator\tests\di\service\geo\GeolocationServiceInterface;

trait Container
{
    use Decorator;

    #[GeolocationService]
    private GeolocationServiceInterface $geolocationService;
}