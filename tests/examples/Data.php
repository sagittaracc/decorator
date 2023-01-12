<?php

namespace Sagittaracc\PhpPythonDecorator\tests\examples;

use Sagittaracc\PhpPythonDecorator\Decorator;
use Sagittaracc\PhpPythonDecorator\tests\decorators\CreateObjectDto;
use Sagittaracc\PhpPythonDecorator\tests\decorators\CreateListDto;
use Sagittaracc\PhpPythonDecorator\tests\decorators\CreateItemsDto;

class Data
{
    use Decorator;

    #[CreateObjectDto]
    protected function getData()
    {
        return [
            'id'      => 1,
            'name'    => 'name',
            'caption' => 'caption',
        ];
    }
    
    #[CreateObjectDto]
    protected function getFailData()
    {
        return [
            'id'            => 1,
            'name'          => 'name',
            'wrong_caption' => 'caption',
        ];
    }

    #[CreateObjectDto]
    protected function getUnvalidData()
    {
        return [
            'id'      => 'unvalid_id',
            'name'    => 'name',
            'caption' => 'caption',
        ];
    }

    #[CreateObjectDto]
    protected function getUnvalidDataOverCustomValidation()
    {
        return [
            'id'      => -1,
            'name'    => 'name',
            'caption' => 'caption',
        ];
    }

    #[CreateListDto]
    protected function getList()
    {
        return [
            '_id' => 1,
            '_items' => $this->run('getItems'),
        ];
    }

    #[CreateItemsDto]
    protected function getItems()
    {
        return [
            '_list' => [
                'item-1',
                'item-2',
                'item-3'
            ],
        ];
    }
}