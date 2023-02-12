<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Sagittaracc\PhpPythonDecorator\tests\examples\Model;

final class TableTest extends TestCase
{
    public function testNoDecorator(): void
    {
        $model = new Model();
        $this->assertNull($model->table);
        $model();
        $this->assertSame('model', $model->table);
    }
}