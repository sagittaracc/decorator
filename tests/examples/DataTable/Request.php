<?php

namespace Sagittaracc\PhpPythonDecorator\tests\examples\DataTable;

use Sagittaracc\PhpPythonDecorator\Decorator;
use Sagittaracc\PhpPythonDecorator\tests\examples\Progress;
use Sagittaracc\PhpPythonDecorator\tests\validators\Length;
use Sagittaracc\PhpPythonDecorator\tests\validators\SerializeOf;

class Request
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

    function __construct($request)
    {
        $this->_name = $request['name'];
        $this->_caption = $request['caption'];
        $this->_progress = $request['progress'];
        $this->_data = $request['data'];
    }
}