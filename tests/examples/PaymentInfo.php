<?php

namespace Sagittaracc\PhpPythonDecorator\tests\examples;

use Sagittaracc\PhpPythonDecorator\Decorator;
use Sagittaracc\PhpPythonDecorator\modules\generics\T;

#[T]
class PaymentInfo
{
    use Decorator;

    public string $id;

    public int $amount;

    #[T]
    public $currency;
}