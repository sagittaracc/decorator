<?php

namespace Sagittaracc\PhpPythonDecorator\modules\rpc\core;

use Exception;
use Sagittaracc\PhpPythonDecorator\Decorator;
use Sagittaracc\PhpPythonDecorator\exceptions\InvalidJsonException;
use Sagittaracc\PhpPythonDecorator\exceptions\ValidationException;
use Sagittaracc\PhpPythonDecorator\modules\validation\core\primitives\Number;
use Sagittaracc\PhpPythonDecorator\modules\validation\core\primitives\Str;

class Request
{
    use Decorator;

    #[Number]
    public $id;

    #[Str]
    public $method;

    public array $params;

    function __construct($rawRequest)
    {
        $request = json_decode($rawRequest);

        if ($request === null) {
            throw new InvalidJsonException;
        }

        try {
            set_decorator_prop($this, 'id', $request->id ?? null);
            set_decorator_prop($this, 'method', $request->method ?? null);
            set_decorator_prop($this, 'params', $request->params ?? []);
        } catch (Exception $e) {
            throw new ValidationException;
        }
    }
}
