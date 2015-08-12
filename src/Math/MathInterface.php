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
}