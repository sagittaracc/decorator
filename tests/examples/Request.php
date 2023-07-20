<?php

namespace Sagittaracc\PhpPythonDecorator\tests\examples;

use Sagittaracc\PhpPythonDecorator\Decorator;
use Sagittaracc\PhpPythonDecorator\tests\validators\ArrayOf;
use Sagittaracc\PhpPythonDecorator\tests\validators\Int8;
use Sagittaracc\PhpPythonDecorator\tests\validators\Length;
use Sagittaracc\PhpPythonDecorator\tests\validators\SerializeArrayOf;
use Sagittaracc\PhpPythonDecorator\tests\validators\SerializeOf;
use Sagittaracc\PhpPythonDecorator\tests\validators\Str;
use Sagittaracc\PhpPythonDecorator\tests\validators\UInt8;

class Request
{
    use Decorator;

    #[Int8]
    public $id;

    #[UInt8]
    public $uid;

    #[Str]
    #[Length(5)]
    public $method;

    #[ArrayOf(UInt8::class)]
    public array $params;

    #[SerializeOf(User::class)]
    public array $user;

    #[SerializeArrayOf(User::class)]
    public array $userList;
}