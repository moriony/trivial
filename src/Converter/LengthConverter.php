<?php
namespace Moriony\Trivial\Converter;

use Moriony\Trivial\Exception\InvalidUnitException;
use Moriony\Trivial\Math\MathInterface;

class LengthConverter implements UnitConverterInterface
{
    const M = 'm';
    const KM = 'km';
    const DM = 'dm';
    const CM = 'cm';
    const MM = 'mm';
    const IN = 'in';
    const FT = 'ft';
    const YD = 'yd';
    const MI = 'mi';

    protected $math;

    public function __construct(MathInterface $math)
    {
        $this->math = $math;
    }

    public function convert($value, $fromUnit, $toUnit)
    {
        $normalized = $this->normalize($value, $fromUnit);

        switch ($toUnit){
            case self::M:
                return $normalized;
            case self::KM:
                return $this->math->div($normalized, 1000);
            case self::DM:
                return $this->math->mul($normalized, 10);
            case self::CM:
                return $this->math->mul($normalized, 100);
            case self::MM:
                return $this->math->mul($normalized, 1000);
            case self::IN:
                return $this->math->mul($normalized, 39.370079);
            case self::FT:
                return $this->math->mul($normalized, 3.280840);
            case self::YD:
                return $this->math->mul($normalized, 1.093613);
            case self::MI:
                return $this->math->mul($normalized, 0.000621);
            default:
                throw new InvalidUnitException(sprintf("Unsupported unit '%s'", $toUnit));
        }
    }

    private function normalize($value, $unit)
    {
        switch ($unit){
            case self::M:
                return $value;
            case self::KM:
                return $this->math->mul($value, 1000);
            case self::DM:
                return $this->math->mul($value, 0.1);
            case self::CM:
                return $this->math->mul($value, 0.01);
            case self::MM:
                return $this->math->mul($value, 0.001);
            case self::IN:
                return $this->math->mul($value, $this->math->div(1, 39.370079));
            case self::FT:
                return $this->math->mul($value, $this->math->div(1, 3.280840));
            case self::YD:
                return $this->math->mul($value, $this->math->div(1, 1.093613));
            case self::MI:
                return $this->math->mul($value, $this->math->div(1, 0.000621));
            default:
                throw new InvalidUnitException(sprintf("Unsupported unit '%s'", $unit));
        }
    }
}