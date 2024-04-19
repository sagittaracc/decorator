<?php

namespace Sagittaracc\PhpPythonDecorator\exceptions\module;

use Exception;

class NotFoundModuleError extends Exception
{
    protected $code = 400;
}