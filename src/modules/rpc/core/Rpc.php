<?php

namespace Sagittaracc\PhpPythonDecorator\modules\rpc\core;

use Attribute;
use Sagittaracc\PhpPythonDecorator\exceptions\InvalidJsonException;
use Sagittaracc\PhpPythonDecorator\exceptions\ValidationException;
use Sagittaracc\PhpPythonDecorator\modules\rpc\JsonRpc;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

#[Attribute]
class Rpc extends PythonDecorator
{
    public function wrapper(mixed $object)
    {
        return function (...$args) use ($object) {
            try {
                $error = false;
                $request = new Request($args[0]);
            } catch (InvalidJsonException $e) {
                $error = true;
                echo JsonRpc::parseError();
            } catch (ValidationException $e) {
                $error = true;
                echo JsonRpc::invalidRequest();
            }

            if (!$error) {
                if (!method_exists($object, $request->method)) {
                    echo JsonRpc::methodNotFound();
                } else {
                    echo JsonRpc::result($object, $request);
                }
            }
        };
    }
}
