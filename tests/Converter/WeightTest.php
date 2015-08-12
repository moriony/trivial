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
        return [
            ['invalid unit', Weight::KG],
            [Weight::KG, 'invalid unit'],
            ['invalid unit', 'invalid unit'],
        ];
    }

    public function provideConvertData()
    {
        return [
            // KG
            [10, Weight::KG, Weight::KG, 10],
            [10, Weight::KG, Weight::G, 10000],
            [10, Weight::KG, Weight::LB, 22.04623],
            [10, Weight::KG, Weight::OZ, 352.73369],

            // G
            [10, Weight::G, Weight::KG, 0.01],
            [10, Weight::G, Weight::G, 10],
            [10, Weight::G, Weight::LB, 0.02204623],
            [10, Weight::G, Weight::OZ, 0.35273369],

            // LB
            [10, Weight::LB, Weight::KG, 4.535922921969],
            [10, Weight::LB, Weight::G, 4535.922921969],
            [10, Weight::LB, Weight::LB, 10],
            [10, Weight::LB, Weight::OZ, 159.99728298217],

            // OZ
            [10, Weight::OZ, Weight::KG, 0.28349999683898],
            [10, Weight::OZ, Weight::G, 283.49999683898],
            [10, Weight::OZ, Weight::LB, 0.62501061353113],
            [10, Weight::OZ, Weight::OZ, 10],
        ];
    }
}