<?php
namespace Moriony\Trivial\Converter;

use Moriony\Trivial\Exception\InvalidUnitException;
use Moriony\Trivial\Math\MathInterface;
use Moriony\Trivial\Unit\LengthUnits;

class LengthConverter implements UnitConverterInterface
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
            case LengthUnits::M:
                return $normalized;
            case LengthUnits::KM:
                return $this->math->div($normalized, 1000);
            case LengthUnits::DM:
                return $this->math->mul($normalized, 10);
            case LengthUnits::CM:
                return $this->math->mul($normalized, 100);
            case LengthUnits::MM:
                return $this->math->mul($normalized, 1000);
            case LengthUnits::IN:
                return $this->math->mul($normalized, 39.370079);
            case LengthUnits::FT:
                return $this->math->mul($normalized, 3.280840);
            case LengthUnits::YD:
                return $this->math->mul($normalized, 1.093613);
            case LengthUnits::MI:
                return $this->math->mul($normalized, 0.000621);
            default:
                throw new InvalidUnitException(sprintf("Unsupported unit '%s'", $toUnit));
        }
    }

    private function normalize($value, $unit)
    {
        switch ($unit){
            case LengthUnits::M:
                return $value;
            case LengthUnits::KM:
                return $this->math->mul($value, 1000);
            case LengthUnits::DM:
                return $this->math->mul($value, 0.1);
            case LengthUnits::CM:
                return $this->math->mul($value, 0.01);
            case LengthUnits::MM:
                return $this->math->mul($value, 0.001);
            case LengthUnits::IN:
                return $this->math->mul($value, $this->math->div(1, 39.370079));
            case LengthUnits::FT:
                return $this->math->mul($value, $this->math->div(1, 3.280840));
            case LengthUnits::YD:
                return $this->math->mul($value, $this->math->div(1, 1.093613));
            case LengthUnits::MI:
                return $this->math->mul($value, $this->math->div(1, 0.000621));
            default:
                throw new InvalidUnitException(sprintf("Unsupported unit '%s'", $unit));
        }
    }
}