<?php

namespace Moriony\Trivial\Math;

use Moriony\Trivial\Converter\UnitConverterInterface;
use Moriony\Trivial\Converter\WeightConverter;
use Moriony\Trivial\Unit\WeightUnits;

class WeightConverterTest extends \PHPUnit_Framework_TestCase
{
    /** @var UnitConverterInterface */
    protected $converter;

    public function setUp()
    {
        $this->converter = new WeightConverter(new NativeMath());
    }

    /**
     * @dataProvider provideInvalidUnits
     */
    public function testInvalidUnitFrom($fromUnit, $toUnit)
    {
        $this->setExpectedException('Moriony\Trivial\Exception\InvalidUnitException', "Unsupported unit 'invalid unit'");
        $this->converter->convert(10, $fromUnit, $toUnit);
    }

    /**
     * @dataProvider provideConvertData
     */
    public function testConvert($value, $fromUnit, $toUnit, $expected)
    {
        $this->assertEquals((string) $expected, (string) $this->converter->convert($value, $fromUnit, $toUnit));
    }

    public function provideInvalidUnits()
    {
        return array(
            array('invalid unit', WeightUnits::KG),
            array(WeightUnits::KG, 'invalid unit'),
            array('invalid unit', 'invalid unit'),
        );
    }

    public function provideConvertData()
    {
        return array(
            // KG
            array(10, WeightUnits::KG, WeightUnits::KG, 10),
            array(10, WeightUnits::KG, WeightUnits::G, 10000),
            array(10, WeightUnits::KG, WeightUnits::LB, 22.04623),
            array(10, WeightUnits::KG, WeightUnits::OZ, 352.73369),

            // G
            array(10, WeightUnits::G, WeightUnits::KG, 0.01),
            array(10, WeightUnits::G, WeightUnits::G, 10),
            array(10, WeightUnits::G, WeightUnits::LB, 0.02204623),
            array(10, WeightUnits::G, WeightUnits::OZ, 0.35273369),

            // LB
            array(10, WeightUnits::LB, WeightUnits::KG, 4.535922921969),
            array(10, WeightUnits::LB, WeightUnits::G, 4535.922921969),
            array(10, WeightUnits::LB, WeightUnits::LB, 10),
            array(10, WeightUnits::LB, WeightUnits::OZ, 159.99728298217),

            // OZ
            array(10, WeightUnits::OZ, WeightUnits::KG, 0.28349999683898),
            array(10, WeightUnits::OZ, WeightUnits::G, 283.49999683898),
            array(10, WeightUnits::OZ, WeightUnits::LB, 0.62501061353113),
            array(10, WeightUnits::OZ, WeightUnits::OZ, 10),
        );
    }
}