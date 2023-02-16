<?php

namespace Sagittaracc\PhpPythonDecorator\tests\Logger;

use Sagittaracc\PhpPythonDecorator\tests\Logger\Di\Container;

class Service
{
    use Container;

    public function doStuff() {
        // do stuff ...
        $messedUp = true;

        if ($messedUp) {
            $this->_logger->emergency('Something went wrong!');
        }
    }
}