<?php

namespace Sagittaracc\PhpPythonDecorator\tests\services\proxy;

class Proxy implements ProxyInterface
{
    public function isAvailable(): bool
    {
        return true;
    }
}