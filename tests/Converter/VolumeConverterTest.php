<?php

namespace Moriony\Trivial\Math;

use Moriony\Trivial\Converter\VolumeConverter;
use Moriony\Trivial\Converter\UnitConverterInterface;

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
            array('invalid unit', VolumeConverter::ML),
            array(VolumeConverter::ML, 'invalid unit'),
            array('invalid unit', 'invalid unit'),
        );
    }

    public function provideConvertData()
    {
        return array(
            // ML
            array(10, VolumeConverter::ML, VolumeConverter::ML, 10),
            array(10, VolumeConverter::ML, VolumeConverter::CM3, 10),
            array(10, VolumeConverter::ML, VolumeConverter::L, 0.01),
            array(10, VolumeConverter::ML, VolumeConverter::M3, 0.00001),
            array(10, VolumeConverter::ML, VolumeConverter::MM3, 10000),
            array(10, VolumeConverter::ML, VolumeConverter::IN3, 0.61023610034722),
            array(10, VolumeConverter::ML, VolumeConverter::FT3, 0.00035314724827664),
            array(10, VolumeConverter::ML, VolumeConverter::YD3, 1.307950862593e-5),
            array(10, VolumeConverter::ML, VolumeConverter::GAL_UK, 0.0021996924829909),
            array(10, VolumeConverter::ML, VolumeConverter::GAL_US, 0.0026417217685799),

            // L
            array(10, VolumeConverter::L, VolumeConverter::ML, 10000),
            array(10, VolumeConverter::L, VolumeConverter::CM3, 10000),
            array(10, VolumeConverter::L, VolumeConverter::L, 10),
            array(10, VolumeConverter::L, VolumeConverter::M3, 0.01),
            array(10, VolumeConverter::L, VolumeConverter::MM3, 10000000),
            array(10, VolumeConverter::L, VolumeConverter::IN3, 610.23610034722),
            array(10, VolumeConverter::L, VolumeConverter::FT3, 0.35314724827664),
            array(10, VolumeConverter::L, VolumeConverter::YD3, 0.013079503763627),
            array(10, VolumeConverter::L, VolumeConverter::GAL_UK, 2.1996924829909),
            array(10, VolumeConverter::L, VolumeConverter::GAL_US, 2.6417217685799),
        );
    }
}