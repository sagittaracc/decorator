<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Sagittaracc\PhpPythonDecorator\tests\examples\Data;
use Sagittaracc\PhpPythonDecorator\tests\decorators\CreateObjectDto;
use Sagittaracc\PhpPythonDecorator\tests\exceptions\DtoException;
use Sagittaracc\PhpPythonDecorator\tests\exceptions\DtoTypeError;
use Sagittaracc\PhpPythonDecorator\tests\exceptions\DtoValidationError;

final class DtoTest extends TestCase
{
    public function testDto(): void
    {
        $data = new Data();
        $dtoData = $data->_getData();

        $this->assertInstanceOf(CreateObjectDto::class, $dtoData);
        $this->assertSame(1, $dtoData->dtoId);
        $this->assertSame('name', $dtoData->dtoName);
        $this->assertSame('caption', $dtoData->dtoCaption);
    }

    public function testFailDto(): void
    {
        $this->expectException(DtoException::class);
        $this->expectExceptionMessage('Sagittaracc\PhpPythonDecorator\tests\decorators\CreateObjectDto::$dtoCaption can not be set because in method Sagittaracc\PhpPythonDecorator\tests\examples\Data::getFailData() property `caption` was not returned!');

        $data = new Data();
        $data->_getFailData();
    }

    public function testUnvalidDto(): void
    {
        $this->expectException(DtoTypeError::class);

        $data = new Data();
        $data->_getUnvalidData();
    }

    public function testUnvalidDtoOverCustomValidation(): void
    {
        $this->expectException(DtoValidationError::class);
        $this->expectExceptionMessage('CreateObjectDto::$dtoId should be positive!');

        $data = new Data();
        $data->_getUnvalidDataOverCustomValidation();
    }

    public function testNestedDto(): void
    {
        $data = new Data();
        $list = $data->_getList();

        $this->assertSame(1, $list->id);
        $this->assertSame(['item-1', 'item-2', 'item-3'], $list->items->list);
    }
}