<?php

namespace Moriony\Trivial\Math;

interface MathInterface
{
    public function mul($a, $b);
    public function div($a, $b);
    public function sum($a, $b);
    public function sub($a, $b);
    public function ceil($a);
    public function floor($a);
    public function eq($a, $b);
    public function greaterThan($a, $b);
    public function greaterOrEqualThan($a, $b);
    public function lessThan($a, $b);
    public function lessOrEqualThan($a, $b);
}