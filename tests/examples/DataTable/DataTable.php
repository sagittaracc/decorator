<?php

namespace Sagittaracc\PhpPythonDecorator\tests\examples\DataTable;

use Sagittaracc\PhpPythonDecorator\Decorator;
use Sagittaracc\PhpPythonDecorator\tests\validators\ArrayOf;
use Sagittaracc\PhpPythonDecorator\tests\validators\Str;

class DataTable
{
    use Decorator;

    #[ArrayOf(Str::class)]
    public array $header;

    #[Table]
    public array $table;
}