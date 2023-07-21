<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Sagittaracc\PhpPythonDecorator\tests\examples\DataTable\Request;

final class ValidationTest extends TestCase
{
    public function testSuccess(): void
    {
        new Request([
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
        ]);

        $this->assertTrue(true);
    }

    public function testLengthFail(): void
    {
        $this->expectExceptionMessage('Sagittaracc\PhpPythonDecorator\tests\examples\DataTable\Request::name validation error! \'fucked_up_table_name\' is not satisfied by Length!');
        new Request([
            'name' => 'fucked_up_table_name',
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
        ]);
    }

    public function testUInt8Fail(): void
    {
        $this->expectExceptionMessage('Sagittaracc\PhpPythonDecorator\tests\examples\DataTable\Request::progress validation error! \'{"max":300,"pos":1,"status":"progress","caption":"in progress..."}\' is not satisfied by SerializeOf(Progress)!');
        new Request([
            'name' => 'my_table',
            'caption' => 'my_table_caption',
            'progress' => [
                'max' => 300,
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
        ]);
    }

    public function testInFail(): void
    {
        $this->expectExceptionMessage('Sagittaracc\PhpPythonDecorator\tests\examples\DataTable\Request::progress validation error! \'{"max":255,"pos":1,"status":"uknown","caption":"in progress..."}\' is not satisfied by SerializeOf(Progress)!');
        new Request([
            'name' => 'my_table',
            'caption' => 'my_table_caption',
            'progress' => [
                'max' => 255,
                'pos' => 1,
                'status' => 'uknown',
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
        ]);
    }

    public function testLessThanFail(): void
    {
        $this->expectExceptionMessage('Sagittaracc\PhpPythonDecorator\tests\examples\DataTable\Request::progress validation error! \'{"max":100,"pos":101,"status":"progress","caption":"in progress..."}\' is not satisfied by SerializeOf(Progress)!');
        new Request([
            'name' => 'my_table',
            'caption' => 'my_table_caption',
            'progress' => [
                'max' => 100,
                'pos' => 101,
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
        ]);
    }

    public function testArrayOfFail(): void
    {
        $this->expectExceptionMessage('Sagittaracc\PhpPythonDecorator\tests\examples\DataTable\Request::data validation error! \'{"header":["col-1",1],"table":{"ins":[["1","2"],["3","4"],["5","6"]]}}\' is not satisfied by SerializeOf(DataTable)');
        new Request([
            'name' => 'my_table',
            'caption' => 'my_table_caption',
            'progress' => [
                'max' => 255,
                'pos' => 1,
                'status' => 'progress',
                'caption' => 'in progress...',
            ],
            'data' => [
                'header' => ['col-1', 1],
                'table' => [
                    'ins' => [
                        ['1', '2'],
                        ['3', '4'],
                        ['5', '6'],
                    ]
                ],
            ]
        ]);
    }

    public function testTableFail(): void
    {
        $this->expectExceptionMessage('Sagittaracc\PhpPythonDecorator\tests\examples\DataTable\Request::data validation error! \'{"header":["col-1","col-2"],"table":{"ins":[[1,2],[1]]}}\' is not satisfied by SerializeOf(DataTable)!');
        new Request([
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
                        [1, 2],
                        [1],
                    ]
                ],
            ]
        ]);
    }
}