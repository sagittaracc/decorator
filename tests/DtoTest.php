<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Sagittaracc\PhpPythonDecorator\tests\classes\Data;
use Sagittaracc\PhpPythonDecorator\tests\decorators\CreateObjectDto;
use Sagittaracc\PhpPythonDecorator\tests\exceptions\DtoException;

final class DtoTest extends TestCase
{
    public function testDto(): void
    {
        $data = new Data();
        $dtoData = $data->getData();

        $this->assertInstanceOf(CreateObjectDto::class, $dtoData);
        $this->assertSame(1, $dtoData->dtoId);
        $this->assertSame('name', $dtoData->dtoName);
        $this->assertSame('caption', $dtoData->dtoCaption);
    }

    public function testFailDto(): void
    {
        $this->expectException(DtoException::class);
        $this->expectExceptionMessage('Dto::$dtoCaption can not be set because Data::$caption is not defined!');

        $data = new Data();
        $data->getFailData();
    }
}