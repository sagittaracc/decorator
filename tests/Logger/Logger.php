<?php

namespace Sagittaracc\PhpPythonDecorator\tests\Logger;

use Attribute;
use Sagittaracc\PhpPythonDecorator\tests\Logger\Psr\Log\LoggerInterface;

#[Attribute]
class Logger implements LoggerInterface
{
    /**
     * {@inheritdoc}
     */
    public function emergency($message, array $context = array())
    {
        echo "\033[01;31m $message \033[0m";
    }

    /**
     * {@inheritdoc}
     */
    public function alert($message, array $context = array()) {}

    /**
     * {@inheritdoc}
     */
    public function critical($message, array $context = array()) {}

    /**
     * {@inheritdoc}
     */
    public function error($message, array $context = array()) {}

    /**
     * {@inheritdoc}
     */
    public function warning($message, array $context = array()) {}

    /**
     * {@inheritdoc}
     */
    public function notice($message, array $context = array()) {}

    /**
     * {@inheritdoc}
     */
    public function info($message, array $context = array()) {}

    /**
     * {@inheritdoc}
     */
    public function debug($message, array $context = array()) {}

    /**
     * {@inheritdoc}
     */
    public function log($level, $message, array $context = array()) {}
}