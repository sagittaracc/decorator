<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Sagittaracc\PhpPythonDecorator\tests\examples\DataTable\Request;

final class ValidationTest extends TestCase
{
    private Request $request;
    private $correctRequest;

    protected function setUp(): void
    {
        $this->request = new Request;
        $this->correctRequest = [
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
    }

    public function testSuccess(): void
    {
        $this->request->load($this->correctRequest);
        $this->assertTrue(true);
    }

    public function testLengthFail(): void
    {
        $this->expectExceptionMessage('Sagittaracc\PhpPythonDecorator\tests\examples\DataTable\Request::name validation error! \'fucked_up_table_name\' is not satisfied by Length!');
        $this->correctRequest['name'] = 'fucked_up_table_name';
        $this->request->load($this->correctRequest);
    }

    public function testUInt8Fail(): void
    {
        $this->expectExceptionMessage('Sagittaracc\PhpPythonDecorator\tests\examples\DataTable\Request::progress validation error! \'{"max":300}\' is not satisfied by SerializeOf(Progress)!');
        $this->correctRequest['progress'] = ['max' => 300];
        $this->request->load($this->correctRequest);
    }

    public function testInFail(): void
    {
        $this->expectExceptionMessage('Sagittaracc\PhpPythonDecorator\tests\examples\DataTable\Request::progress validation error! \'{"status":"unknown"}\' is not satisfied by SerializeOf(Progress)!');
        $this->correctRequest['progress'] = ['status' => 'unknown'];
        $this->request->load($this->correctRequest);
    }

    public function testLessThanFail(): void
    {
        $this->expectExceptionMessage('Sagittaracc\PhpPythonDecorator\tests\examples\DataTable\Request::progress validation error! \'{"max":100,"pos":101}\' is not satisfied by SerializeOf(Progress)!');
        $this->correctRequest['progress'] = ['max' => 100, 'pos' => 101];
        $this->request->load($this->correctRequest);
    }

    public function testArrayOfFail(): void
    {
        $this->expectExceptionMessage('Sagittaracc\PhpPythonDecorator\tests\examples\DataTable\Request::data validation error! \'{"header":["col-1",1],"table":{"ins":[["1","2"],["3","4"],["5","6"]]}}\' is not satisfied by SerializeOf(DataTable)');
        $this->correctRequest['data']['header'] = ['col-1', 1];
        $this->request->load($this->correctRequest);
    }

    public function testTableFail(): void
    {
        $this->expectExceptionMessage('Sagittaracc\PhpPythonDecorator\tests\examples\DataTable\Request::data validation error! \'{"header":["col-1","col-2"],"table":{"ins":[[1,2],[1]]}}\' is not satisfied by SerializeOf(DataTable)!');
        $this->correctRequest['data'] = [
            'header' => ['col-1', 'col-2'],
            'table' => [
                'ins' => [
                    [1, 2],
                    [1]
                ]
            ]
        ];
        $this->request->load($this->correctRequest);
    }
}