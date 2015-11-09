<?php

namespace Moriony\Trivial\Exception;

class InvalidUnitException extends InvalidArgumentException
{
    protected $message = 'Invalid unit.';
}