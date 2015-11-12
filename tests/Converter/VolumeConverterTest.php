<?php

namespace Moriony\Trivial\Math;

use Moriony\Trivial\Converter\VolumeConverter;
use Moriony\Trivial\Converter\UnitConverterInterface;
use Moriony\Trivial\Unit\VolumeUnits;

class VolumeConverterTest extends \PHPUnit_Framework_TestCase
{
    /** @var UnitConverterInterface */
    protected $converter;

    public function setUp()
    {
        $this->converter = new VolumeConverter(new NativeMath());
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
            array('invalid unit', VolumeUnits::ML),
            array(VolumeUnits::ML, 'invalid unit'),
            array('invalid unit', 'invalid unit'),
        );
    }

    public function provideConvertData()
    {
        return array(
            // ML
            array(10, VolumeUnits::ML, VolumeUnits::ML, 10),
            array(10, VolumeUnits::ML, VolumeUnits::CM3, 10),
            array(10, VolumeUnits::ML, VolumeUnits::L, 0.01),
            array(10, VolumeUnits::ML, VolumeUnits::M3, 0.00001),
            array(10, VolumeUnits::ML, VolumeUnits::MM3, 10000),
            array(10, VolumeUnits::ML, VolumeUnits::IN3, 0.61023610034722),
            array(10, VolumeUnits::ML, VolumeUnits::FT3, 0.00035314724827664),
            array(10, VolumeUnits::ML, VolumeUnits::YD3, 1.307950862593e-5),
            array(10, VolumeUnits::ML, VolumeUnits::GAL_UK, 0.0021996924829909),
            array(10, VolumeUnits::ML, VolumeUnits::GAL_US, 0.0026417217685799),

            // L
            array(10, VolumeUnits::L, VolumeUnits::ML, 10000),
            array(10, VolumeUnits::L, VolumeUnits::CM3, 10000),
            array(10, VolumeUnits::L, VolumeUnits::L, 10),
            array(10, VolumeUnits::L, VolumeUnits::M3, 0.01),
            array(10, VolumeUnits::L, VolumeUnits::MM3, 10000000),
            array(10, VolumeUnits::L, VolumeUnits::IN3, 610.23610034722),
            array(10, VolumeUnits::L, VolumeUnits::FT3, 0.35314724827664),
            array(10, VolumeUnits::L, VolumeUnits::YD3, 0.013079503763627),
            array(10, VolumeUnits::L, VolumeUnits::GAL_UK, 2.1996924829909),
            array(10, VolumeUnits::L, VolumeUnits::GAL_US, 2.6417217685799),
        );
    }
}