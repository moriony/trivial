<?php
namespace Moriony\Trivial\Converter;

use Moriony\Trivial\Exception\InvalidUnitException;
use Moriony\Trivial\Math\MathInterface;

class CapacityConverter implements UnitConverterInterface
{
    const ML = 'ml';
    const L = 'l';
    const MM3 = 'mm3';
    const CM3 = 'cm3';
    const M3 = 'm3';
    const IN3 = 'in3';
    const FT3 = 'ft3';
    const YD3 = 'yd3';
    const GAL_UK = 'galUK';
    const GAL_US = 'galUS';

    protected $math;

    public function __construct(MathInterface $math)
    {
        $this->math = $math;
    }

    public function convert($value, $fromUnit, $toUnit)
    {
        $normalized = $this->normalize($value, $fromUnit);

        switch ($toUnit){
            case self::L:
                return $normalized;
            case self::ML:
            case self::CM3:
                return $this->math->div($normalized, 0.001);
            case self::MM3:
                return $this->math->div($normalized, 0.000001);
            case self::M3:
                return $this->math->div($normalized, 1000);
            case self::IN3:
                return $this->math->div($normalized, 0.0163871);
            case self::FT3:
                return $this->math->div($normalized, 28.3168);
            case self::YD3:
                return $this->math->div($normalized, 764.555);
            case self::GAL_UK:
                return $this->math->div($normalized, 4.54609);
            case self::GAL_US:
                return $this->math->div($normalized, 3.78541);
            default:
                throw new InvalidUnitException(sprintf("Unsupported unit '%s'", $toUnit));
        }
    }

    private function normalize($value, $unit)
    {
        switch ($unit){
            case self::L:
                return $value;
            case self::ML:
            case self::CM3:
                return $this->math->mul($value, 0.001);
            case self::MM3:
                return $this->math->mul($value, 0.000001);
            case self::M3:
                return $this->math->mul($value, 1000);
            case self::IN3:
                return $this->math->mul($value, 0.0163871);
            case self::FT3:
                return $this->math->mul($value, 28.3168);
            case self::YD3:
                return $this->math->mul($value, 764.555);
            case self::GAL_UK:
                return $this->math->mul($value, 4.54609);
            case self::GAL_US:
                return $this->math->mul($value, 3.78541);
            default:
                throw new InvalidUnitException(sprintf("Unsupported unit '%s'", $unit));
        }
    }
}