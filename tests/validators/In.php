<?php

namespace Sagittaracc\PhpPythonDecorator\tests\validators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\modules\validation\core\Validator;
use sagittaracc\PlaceholderHelper;

#[Attribute]
final class In extends Validator
{
    public array $in;

    function __construct(...$in)
    {
        $this->in = $in;
    }

    public function validation($value)
    {
        if (in_array($value, $this->in)) {
            return true;
        }

        $this->addError((new PlaceholderHelper("`$value` is not one of ?"))->bind($this->in));

        return false;
    }
}