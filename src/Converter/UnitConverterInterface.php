<?php

namespace Moriony\Trivial\Converter;

interface UnitConverterInterface
{
    public function convert($value, $fromUnit, $toUnit);
}