<?php

namespace Sagittaracc\PhpPythonDecorator\tests\examples\DataTable;

use Attribute;
use Sagittaracc\PhpPythonDecorator\Validator;

#[Attribute]
final class Table extends Validator
{
    public function validation($value)
    {
        if (isset($value['ins']) && !$this->validateIns($value['ins'])) {
            return false;
        }

        return true;
    }

    private function validateIns($ins)
    {
        if (!is_array($ins)) {
            return false;
        }

        if (!array_is_list($ins)) {
            return false;
        }

        $colCount = count($this->getObject()->header);

        foreach ($ins as $row) {
            if (!is_array($row)) {
                return false;
            }

            if (!array_is_list($row)) {
                return false;
            }

            if (count($row) !== $colCount) {
                $this->addError($this->getTmp() . ' validation error! Row count does not match col count!');
                return false;
            }
        }

        return true;
    }
}