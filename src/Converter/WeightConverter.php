<?php
namespace Moriony\Trivial\Converter;

use Moriony\Trivial\Exception\InvalidUnitException;
use Moriony\Trivial\Math\MathInterface;
use Moriony\Trivial\Unit\WeightUnits;

class WeightConverter implements UnitConverterInterface
{
    protected $math;

    public function __construct(MathInterface $math)
    {
        $this->math = $math;
    }

    public function convert($value, $fromUnit, $toUnit)
    {
        $normalized = $this->normalize($value, $fromUnit);

        switch ($toUnit){
            case WeightUnits::G:
                return $this->math->mul($normalized, 1000);
            case WeightUnits::KG:
                return $normalized;
            case WeightUnits::OZ:
                return $this->math->mul($normalized, 35.273369);
            case WeightUnits::LB:
                return $this->math->mul($normalized, 2.204623);
            default:
                throw new InvalidUnitException(sprintf("Unsupported unit '%s'", $toUnit));
        }
    }

    private function normalize($value, $unit)
    {
        switch ($unit) {
            case WeightUnits::G:
                return $this->math->div($value, 1000);
            case WeightUnits::KG:
                return $value;
            case WeightUnits::OZ:
                return $this->math->div($value, 35.273369);
            case WeightUnits::LB:
                return $this->math->div($value, 2.204623);
            default:
                throw new InvalidUnitException(sprintf("Unsupported unit '%s'", $unit));
        }
    }
}