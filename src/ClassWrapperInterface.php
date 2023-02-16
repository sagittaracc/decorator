<?php

namespace Sagittaracc\PhpPythonDecorator;

interface ClassWrapperInterface
{
    public function bindTo($object): self;
    public function getInstance();
}