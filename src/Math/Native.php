<?php

namespace Moriony\Trivial\Math;

class Native implements MathInterface
{
    public function mul($a, $b)
    {
        return $a * $b;
    }

    public function div($a, $b)
    {
        return $a / $b;
    }

    public function sum($a, $b)
    {
        return $a + $b;
    }

    public function sub($a, $b)
    {
        return $a - $b;
    }

    public function ceil($a)
    {
        return ceil($a);
    }

    public function floor($a)
    {
        return floor($a);
    }
}