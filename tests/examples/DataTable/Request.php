<?php

namespace Sagittaracc\PhpPythonDecorator\tests\examples\DataTable;

use Sagittaracc\PhpPythonDecorator\Decorator;
use Sagittaracc\PhpPythonDecorator\tests\examples\DataTable\BaseRequest;
use Sagittaracc\PhpPythonDecorator\tests\examples\DataTable\Progress;
use Sagittaracc\PhpPythonDecorator\tests\validators\Length;
use Sagittaracc\PhpPythonDecorator\tests\validators\SerializeOf;

class Request extends BaseRequest
{
    use Decorator;

    #[Length(8)]
    public string $name;

    #[Length(32)]
    public string $caption;

    #[SerializeOf(Progress::class)]
    public array $progress;

    #[SerializeOf(DataTable::class)]
    public array $data;
}