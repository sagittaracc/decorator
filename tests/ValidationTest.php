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
        $this->expectExceptionMessage('Sagittaracc\PhpPythonDecorator\tests\examples\DataTable\Request::progress validation error! {"message":"Sagittaracc\PhpPythonDecorator\tests\examples\Progress::max validation error! 300 is not satisfied by UInt8!"} is not satisfied by SerializeOf(Progress)!');
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
        $this->expectExceptionMessage('Sagittaracc\PhpPythonDecorator\tests\examples\DataTable\Request::progress validation error! {"message":"Sagittaracc\PhpPythonDecorator\tests\examples\Progress::status validation error! \'uknown\' is not satisfied by In!"} is not satisfied by SerializeOf(Progress)!');
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
        $this->expectExceptionMessage('Sagittaracc\PhpPythonDecorator\tests\examples\DataTable\Request::progress validation error! {"message":"Sagittaracc\PhpPythonDecorator\tests\examples\Progress::pos validation error! 101 is not satisfied by LessThan!"} is not satisfied by SerializeOf(Progress)!');
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
        $this->expectExceptionMessage('Sagittaracc\PhpPythonDecorator\tests\examples\DataTable\Request::data validation error! {"message":"Sagittaracc\PhpPythonDecorator\tests\examples\DataTable\DataTable::header validation error! [\'col-1\',1] is not satisfied by ArrayOf(Str)!"} is not satisfied by SerializeOf(DataTable)!');
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
        $this->expectExceptionMessage('Sagittaracc\PhpPythonDecorator\tests\examples\DataTable\Request::data validation error! {"message":"Sagittaracc\PhpPythonDecorator\tests\examples\DataTable\DataTable::table validation error! {\"ins\":[[1,2],[1]]} is not satisfied by Table!"} is not satisfied by SerializeOf(DataTable)!');
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