<?php

namespace Sagittaracc\PhpPythonDecorator\tests\examples\DataTable;

use Attribute;
use Sagittaracc\PhpPythonDecorator\modules\validation\Validator;

#[Attribute]
final class Table extends Validator
{
    public function validation($value)
    {
        if (isset($value['ins']) && !$this->validateIns($value['ins'])) {
            $this->addError('Row count does not match col count in `ins` section!');
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

        $colCount = count($this->getObject()->header ?? []);

        foreach ($ins as $row) {
            if (!is_array($row)) {
                return false;
            }

            if (!array_is_list($row)) {
                return false;
            }

            if (count($row) !== $colCount) {
                return false;
            }
        }

        return true;
    }
}