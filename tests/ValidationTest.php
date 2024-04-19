<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Sagittaracc\PhpPythonDecorator\modules\validation\Validation;
use Sagittaracc\PhpPythonDecorator\tests\examples\Box;
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
        $this->expectExceptionMessage('Sagittaracc\PhpPythonDecorator\tests\examples\DataTable\Request:name -> `fucked_up_table_name` is not length of 8');
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
        $this->expectExceptionMessage('Sagittaracc\PhpPythonDecorator\tests\examples\DataTable\Request:progress -> Sagittaracc\PhpPythonDecorator\tests\examples\DataTable\Progress:max -> `300` is not between 0 and 255');
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
        $this->expectExceptionMessage('Sagittaracc\PhpPythonDecorator\tests\examples\DataTable\Request:progress -> Sagittaracc\PhpPythonDecorator\tests\examples\DataTable\Progress:status -> `unknown` is not one of [\'progress\',\'finish\',\'aborted\']');
        new Request([
            'name' => 'my_table',
            'caption' => 'my_table_caption',
            'progress' => [
                'max' => 255,
                'pos' => 1,
                'status' => 'unknown',
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
        $this->expectExceptionMessage('Sagittaracc\PhpPythonDecorator\tests\examples\DataTable\Request:progress -> Sagittaracc\PhpPythonDecorator\tests\examples\DataTable\Progress:pos -> `101` is not less than 100');
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
        $this->expectExceptionMessage('Sagittaracc\PhpPythonDecorator\tests\examples\DataTable\Request:data -> Sagittaracc\PhpPythonDecorator\tests\examples\DataTable\DataTable:header -> Something wrong with `1`');
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
        $this->expectExceptionMessage('Sagittaracc\PhpPythonDecorator\tests\examples\DataTable\Request:data -> Sagittaracc\PhpPythonDecorator\tests\examples\DataTable\DataTable:table -> Row count does not match col count in `ins` section!');
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

    public function testManyValidationFail(): void
    {
        $this->expectExceptionMessage(
            "Sagittaracc\PhpPythonDecorator\\tests\\examples\DataTable\Request:progress -> " .
                "Sagittaracc\PhpPythonDecorator\\tests\\examples\DataTable\Progress:max -> `300` is not between 0 and 255\n" .
                "Sagittaracc\PhpPythonDecorator\\tests\\examples\DataTable\Progress:pos -> `301` is not between 0 and 255\n" .
                "Sagittaracc\PhpPythonDecorator\\tests\\examples\DataTable\Progress:status -> `unknown` is not one of ['progress','finish','aborted']"
        );
        new Request([
            'name' => 'my_table',
            'caption' => 'my_table_caption',
            'progress' => [
                'max' => 300,
                'pos' => 301,
                'status' => 'unknown',
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

    public function testBrandNewValidator(): void
    {
        $this->expectNotToPerformAssertions();

        $box = new Box();
        set_decorator_prop($box, 'name', 'box');
    }

    public function testBrandNewValidatorFail(): void
    {
        $this->expectExceptionMessage('Sagittaracc\PhpPythonDecorator\tests\examples\Box::name `boxx` is not length of 3');

        $box = new Box();
        set_decorator_prop($box, 'name', 'boxx');
        set_decorator_prop($box, 'size', '11111');

        /**
         * COMMENT: This is how you can get all the errors and warnings
         * set validator debug option to false
         * $log = Validation::getInstanceFrom($box)->getLog();
         */
    }
}