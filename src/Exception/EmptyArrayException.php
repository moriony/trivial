<?php

namespace Moriony\Trivial\Exception;

class EmptyArrayException extends \Exception implements BasicExceptionInterface
{
    protected $message = 'Empty array';
}