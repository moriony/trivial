<?php

namespace Moriony\Trivial\Exception;

class InvalidArgumentException extends \InvalidArgumentException implements BasicExceptionInterface
{
    protected $message = 'Invalid argument.';
}