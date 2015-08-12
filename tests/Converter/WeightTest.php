<?php

namespace Moriony\Trivial\Math;

use Moriony\Trivial\Converter\UnitConverterInterface;
use Moriony\Trivial\Converter\Weight;

class WeightTest extends \PHPUnit_Framework_TestCase
{
    /** @var UnitConverterInterface */
    protected $converter;

    public function setUp()
    {
        $this->converter = new Weight(new Native());
    }

    /**
     * @dataProvider provideInvalidUnits
     */
    public function testInvalidUnitFrom($fromUnit, $toUnit)
    {
        $this->setExpectedException('Moriony\Trivial\Exception\InvalidUnit', "Unsupported unit 'invalid unit'");
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
            array('invalid unit', Weight::KG),
            array(Weight::KG, 'invalid unit'),
            array('invalid unit', 'invalid unit'),
        );
    }

    public function provideConvertData()
    {
        return array(
            // KG
            array(10, Weight::KG, Weight::KG, 10),
            array(10, Weight::KG, Weight::G, 10000),
            array(10, Weight::KG, Weight::LB, 22.04623),
            array(10, Weight::KG, Weight::OZ, 352.73369),

            // G
            array(10, Weight::G, Weight::KG, 0.01),
            array(10, Weight::G, Weight::G, 10),
            array(10, Weight::G, Weight::LB, 0.02204623),
            array(10, Weight::G, Weight::OZ, 0.35273369),

            // LB
            array(10, Weight::LB, Weight::KG, 4.535922921969),
            array(10, Weight::LB, Weight::G, 4535.922921969),
            array(10, Weight::LB, Weight::LB, 10),
            array(10, Weight::LB, Weight::OZ, 159.99728298217),

            // OZ
            array(10, Weight::OZ, Weight::KG, 0.28349999683898),
            array(10, Weight::OZ, Weight::G, 283.49999683898),
            array(10, Weight::OZ, Weight::LB, 0.62501061353113),
            array(10, Weight::OZ, Weight::OZ, 10),
        );
    }
}