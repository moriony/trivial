<?php

namespace Moriony\Trivial\Math;

interface MathInterface
{
    public function mul($a, $b);
    public function div($a, $b);
    public function sum($a, $b);
    public function sub($a, $b);
    public function roundUp($a, $precision = 0);
    public function roundDown($a, $precision = 0);
    public function roundHalfUp($a, $precision = 0);
    public function roundHalfDown($a, $precision = 0);
    public function eq($a, $b);
    public function greaterThan($a, $b);
    public function greaterOrEqualThan($a, $b);
    public function lessThan($a, $b);
    public function lessOrEqualThan($a, $b);
    public function pow($a, $b);
    public function sqrt($a);
    public function comp($a, $b);
    public function abs($a);
}