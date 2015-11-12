<?php

namespace Moriony\Trivial\Math;

use Moriony\Trivial\Converter\CapacityConverter;
use Moriony\Trivial\Converter\UnitConverterInterface;

class CapacityConverterTest extends \PHPUnit_Framework_TestCase
{
    /** @var UnitConverterInterface */
    protected $converter;

    public function setUp()
    {
        $this->converter = new CapacityConverter(new NativeMath());
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
        $this->assertEquals($expected, $this->converter->convert($value, $fromUnit, $toUnit));
    }

    public function provideInvalidUnits()
    {
        return array(
            array('invalid unit', CapacityConverter::ML),
            array(CapacityConverter::ML, 'invalid unit'),
            array('invalid unit', 'invalid unit'),
        );
    }

    public function provideConvertData()
    {
        return array(
            // ML
            array(10, CapacityConverter::ML, CapacityConverter::ML, 10),
            array(10, CapacityConverter::ML, CapacityConverter::CM3, 10),
            array(10, CapacityConverter::ML, CapacityConverter::L, 0.01),
            array(10, CapacityConverter::ML, CapacityConverter::M3, 0.00001),
            array(10, CapacityConverter::ML, CapacityConverter::MM3, 10000),
            array(10, CapacityConverter::ML, CapacityConverter::IN3, 0.61023610034722),
            array(10, CapacityConverter::ML, CapacityConverter::FT3, 0.00035314724827664),
            array(10, CapacityConverter::ML, CapacityConverter::YD3, 1.307950862593e-5),
            array(10, CapacityConverter::ML, CapacityConverter::GAL_UK, 0.0021996924829909),
            array(10, CapacityConverter::ML, CapacityConverter::GAL_US, 0.0026417217685799),

            // L
            array(10, CapacityConverter::L, CapacityConverter::ML, 10000),
            array(10, CapacityConverter::L, CapacityConverter::CM3, 10000),
            array(10, CapacityConverter::L, CapacityConverter::L, 10),
            array(10, CapacityConverter::L, CapacityConverter::M3, 0.01),
            array(10, CapacityConverter::L, CapacityConverter::MM3, 10000000),
            array(10, CapacityConverter::L, CapacityConverter::IN3, 610.23610034722),
            array(10, CapacityConverter::L, CapacityConverter::FT3, 0.35314724827664),
            array(10, CapacityConverter::L, CapacityConverter::YD3, 0.013079503763627),
            array(10, CapacityConverter::L, CapacityConverter::GAL_UK, 2.1996924829909),
            array(10, CapacityConverter::L, CapacityConverter::GAL_US, 2.6417217685799),
        );
    }
}