<?php

namespace Sagittaracc\PhpPythonDecorator\tests\Logger\Di;

use Sagittaracc\PhpPythonDecorator\Decorator;
use Sagittaracc\PhpPythonDecorator\tests\Logger\Logger;
use Sagittaracc\PhpPythonDecorator\tests\Logger\Psr\Log\LoggerInterface;

trait Container
{
    use Decorator;

    #[Logger]
    private LoggerInterface $logger;
}