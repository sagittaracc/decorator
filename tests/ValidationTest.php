<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Sagittaracc\PhpPythonDecorator\tests\examples\DataTable\Request;

final class ValidationTest extends TestCase
{
    private Request $request;

    protected function setUp(): void
    {
        $this->request = new Request;
    }

    public function testSuccess(): void
    {
        $correctRequest = [
            'name' => 'my_table',
            'caption' => 'my_table_caption',
            'progress' => [
                'max' => 255,
                'pos' => 1,
                'status' => 'progress',
                'caption' => 'in progress...',
            ],
            'data' => [
                'header' => ['col-1', 'col-2'],
                'table' => [
                    'ins' => [
                        ['1', '2'],
                        ['3', '4'],
                        ['5', '6'],
                    ]
                ],
            ]
        ];

        $this->request->_name = $correctRequest['name'];
        $this->request->_caption = $correctRequest['caption'];
        $this->request->_progress = $correctRequest['progress'];
        $this->request->_data = $correctRequest['data'];

        $this->assertSame($correctRequest['name'], $this->request->name);
        $this->assertSame($correctRequest['caption'], $this->request->caption);
        $this->assertSame($correctRequest['progress'], $this->request->progress);
        $this->assertSame($correctRequest['data'], $this->request->data);
    }

    public function testLengthFail(): void
    {
        $this->expectExceptionMessage('Sagittaracc\PhpPythonDecorator\tests\examples\DataTable\Request::name validation error! \'some_table\' is not satisfied by Length!');
        $this->request->_name = 'some_table';
    }

    public function testUInt8Fail(): void
    {
        $this->expectExceptionMessage('Sagittaracc\PhpPythonDecorator\tests\examples\DataTable\Request::progress validation error! \'{"max":300}\' is not satisfied by SerializeOf(Progress)!');
        $this->request->_progress = ['max' => 300];
    }

    public function testInFail(): void
    {
        $this->expectExceptionMessage('Sagittaracc\PhpPythonDecorator\tests\examples\DataTable\Request::progress validation error! \'{"status":"unknown"}\' is not satisfied by SerializeOf(Progress)!');
        $this->request->_progress = ['status' => 'unknown'];
    }

    public function testLessThanFail(): void
    {
        $this->expectExceptionMessage('Sagittaracc\PhpPythonDecorator\tests\examples\DataTable\Request::progress validation error! \'{"max":100,"pos":101}\' is not satisfied by SerializeOf(Progress)!');
        $this->request->_progress = ['max' => 100, 'pos' => 101];
    }

    public function testArrayOfFail(): void
    {
        $this->expectExceptionMessage('Sagittaracc\PhpPythonDecorator\tests\examples\DataTable\Request::data validation error! \'{"header":["col-1",1]}\' is not satisfied by SerializeOf(DataTable)');
        $this->request->_data = ['header' => ['col-1', 1]];
    }

    public function testTableFail(): void
    {
        $this->expectExceptionMessage('Sagittaracc\PhpPythonDecorator\tests\examples\DataTable\Request::data validation error! \'{"header":["col-1","col-2"],"table":{"ins":[[1,2],[1]]}}\' is not satisfied by SerializeOf(DataTable)!');
        $this->request->_data = [
            'header' => ['col-1', 'col-2'],
            'table' => [
                'ins' => [
                    [1, 2],
                    [1]
                ]
            ]
        ];
    }
}