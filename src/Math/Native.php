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

    public function roundUp($a, $precision = 0)
    {
        $c = (string) $this->pow(10, $precision);
        $mul = (string) $this->mul($a, $c);
        $ceil = ceil($mul);
        return $this->div($ceil, $c);
    }

    public function roundDown($a, $precision = 0)
    {
        $c = (string) $this->pow(10, $precision);
        $mul = (string) $this->mul($a, $c);
        $floor = floor($mul);
        return $this->div($floor, $c);
    }

    public function roundHalfUp($a, $precision = 0)
    {
        return round($a, $precision, PHP_ROUND_HALF_UP);
    }

    public function roundHalfDown($a, $precision = 0)
    {
        return round($a, $precision, PHP_ROUND_HALF_DOWN);
    }

    public function eq($a, $b)
    {
        return $a == $b;
    }

    public function greaterThan($a, $b)
    {
        return $a > $b;
    }

    public function greaterOrEqualThan($a, $b)
    {
        return $a >= $b;
    }

    public function lessThan($a, $b)
    {
        return $a < $b;
    }

    public function lessOrEqualThan($a, $b)
    {
        return $a <= $b;
    }

    public function comp($a, $b)
    {
        if ($a > $b) {
            return 1;
        }
        if ($a < $b) {
            return -1;
        }
        return 0;
    }

    public function pow($a, $b)
    {
        return pow($a, $b);
    }

    public function sqrt($a)
    {
        return sqrt($a);
    }

    public function abs($a)
    {
        return abs($a);
    }
}