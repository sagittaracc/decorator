<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Sagittaracc\PhpPythonDecorator\tests\classes\Data;

final class DtoTest extends TestCase
{
    public function testDto(): void
    {
        $data = new Data();
        $this->assertSame([
            'dtoId'      => 1,
            'dtoName'    => 'name',
            'dtoCaption' => 'caption',
        ], $data->getData());
    }
}