<?php

namespace Sagittaracc\PhpPythonDecorator\modules\rpc;

use Sagittaracc\PhpPythonDecorator\modules\Module;

class JsonRpc extends Module
{
    public static function parseError()
    {
        return json_encode(['error' => 'Parse error', 'code' => -32700]);
    }

    public static function invalidRequest()
    {
        return json_encode(['error' => 'Invalid request', 'code' => -32600]);
    }

    public static function methodNotFound()
    {
        return json_encode(['error' => 'Method not found', 'code' => -32601]);
    }

    public static function result($object, $request)
    {
        $id = $request->id;
        $method = $request->method;
        $params = $request->params;

        return json_encode([
            'json-rpc' => '2.0',
            'id' => $id,
            'result' => call_user_func_array([$object, $method], $params),
        ]);
    }
}
