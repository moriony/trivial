<?php
namespace Moriony\Trivial\Converter;

use Moriony\Trivial\Exception\InvalidUnitException;
use Moriony\Trivial\Math\MathInterface;

class WeightConverter implements UnitConverterInterface
{
    const G = 'g';
    const KG = 'kg';
    const OZ = 'oz';
    const LB = 'lb';

    protected $math;

    public function __construct(MathInterface $math)
    {
        $this->math = $math;
    }

    public function convert($value, $fromUnit, $toUnit)
    {
        $normalized = $this->normalize($value, $fromUnit);

        switch ($toUnit){
            case self::G:
                return $this->math->mul($normalized, 1000);
            case self::KG:
                return $normalized;
            case self::OZ:
                return $this->math->mul($normalized, 35.273369);
            case self::LB:
                return $this->math->mul($normalized, 2.204623);
            default:
                throw new InvalidUnitException(sprintf("Unsupported unit '%s'", $toUnit));
        }
    }

    private function normalize($value, $unit)
    {
        switch ($unit) {
            case self::G:
                return $this->math->div($value, 1000);
            case self::KG:
                return $value;
            case self::OZ:
                return $this->math->div($value, 35.273369);
            case self::LB:
                return $this->math->div($value, 2.204623);
            default:
                throw new InvalidUnitException(sprintf("Unsupported unit '%s'", $unit));
        }
    }
}