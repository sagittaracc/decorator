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
    function _getData()
    {
        return [
            'id'      => 1,
            'name'    => 'name',
            'caption' => 'caption',
        ];
    }
    
    #[CreateObjectDto]
    function _getFailData()
    {
        return [
            'id'            => 1,
            'name'          => 'name',
            'wrong_caption' => 'caption',
        ];
    }

    #[CreateObjectDto]
    function _getUnvalidData()
    {
        return [
            'id'      => 'unvalid_id',
            'name'    => 'name',
            'caption' => 'caption',
        ];
    }

    #[CreateObjectDto]
    function _getUnvalidDataOverCustomValidation()
    {
        return [
            'id'      => -1,
            'name'    => 'name',
            'caption' => 'caption',
        ];
    }

    #[CreateListDto]
    function _getList()
    {
        return [
            '_id' => 1,
            '_items' => $this->getItems(),
        ];
    }

    #[CreateItemsDto]
    function _getItems()
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