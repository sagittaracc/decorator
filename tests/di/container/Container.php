<?php

namespace Sagittaracc\PhpPythonDecorator\tests\di\container;

use Psr\Log\LoggerInterface;
use Sagittaracc\PhpPythonDecorator\Decorator;
use Sagittaracc\PhpPythonDecorator\tests\di\Di;
use Sagittaracc\PhpPythonDecorator\tests\di\service\geo\GeolocationService;
use Sagittaracc\PhpPythonDecorator\tests\di\service\geo\GeolocationServiceInterface;
use Yiisoft\Log\Logger;
use Yiisoft\Log\Target\File\FileTarget;

trait Container
{
    use Decorator;

    #[Di(GeolocationService::class)]
    private GeolocationServiceInterface $geolocationService;



    #[Di(
        class: Logger::class,
        construct: [FileTarget::class]
    )]
    private LoggerInterface $logger;

    #[Di(
        class: FileTarget::class,
        construct: ['app.log']
    )]
    private FileTarget $fileTarget;
}