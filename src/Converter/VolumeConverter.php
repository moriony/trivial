<?php
namespace Moriony\Trivial\Converter;

use Moriony\Trivial\Exception\InvalidUnitException;
use Moriony\Trivial\Math\MathInterface;
use Moriony\Trivial\Unit\VolumeUnits;

class VolumeConverter implements UnitConverterInterface
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
            case VolumeUnits::L:
                return $normalized;
            case VolumeUnits::ML:
            case VolumeUnits::CM3:
                return $this->math->div($normalized, 0.001);
            case VolumeUnits::MM3:
                return $this->math->div($normalized, 0.000001);
            case VolumeUnits::M3:
                return $this->math->div($normalized, 1000);
            case VolumeUnits::IN3:
                return $this->math->div($normalized, 0.0163871);
            case VolumeUnits::FT3:
                return $this->math->div($normalized, 28.3168);
            case VolumeUnits::YD3:
                return $this->math->div($normalized, 764.555);
            case VolumeUnits::GAL_UK:
                return $this->math->div($normalized, 4.54609);
            case VolumeUnits::GAL_US:
                return $this->math->div($normalized, 3.78541);
            default:
                throw new InvalidUnitException(sprintf("Unsupported unit '%s'", $toUnit));
        }
    }

    private function normalize($value, $unit)
    {
        switch ($unit){
            case VolumeUnits::L:
                return $value;
            case VolumeUnits::ML:
            case VolumeUnits::CM3:
                return $this->math->mul($value, 0.001);
            case VolumeUnits::MM3:
                return $this->math->mul($value, 0.000001);
            case VolumeUnits::M3:
                return $this->math->mul($value, 1000);
            case VolumeUnits::IN3:
                return $this->math->mul($value, 0.0163871);
            case VolumeUnits::FT3:
                return $this->math->mul($value, 28.3168);
            case VolumeUnits::YD3:
                return $this->math->mul($value, 764.555);
            case VolumeUnits::GAL_UK:
                return $this->math->mul($value, 4.54609);
            case VolumeUnits::GAL_US:
                return $this->math->mul($value, 3.78541);
            default:
                throw new InvalidUnitException(sprintf("Unsupported unit '%s'", $unit));
        }
    }
}