<?php

namespace Moriony\Trivial\Math;

use Moriony\Trivial\Converter\LengthConverter;
use Moriony\Trivial\Converter\UnitConverterInterface;

class LengthConverterTest extends \PHPUnit_Framework_TestCase
{
    /** @var UnitConverterInterface */
    protected $converter;

    public function setUp()
    {
        $this->converter = new LengthConverter(new NativeMath());
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
            array('invalid unit', LengthConverter::CM),
            array(LengthConverter::CM, 'invalid unit'),
            array('invalid unit', 'invalid unit'),
        );
    }

    public function provideConvertData()
    {
        return array(
            // M
            array(10, LengthConverter::M, LengthConverter::M, 10),
            array(10, LengthConverter::M, LengthConverter::KM, 0.01),
            array(10, LengthConverter::M, LengthConverter::DM, 100),
            array(10, LengthConverter::M, LengthConverter::CM, 1000),
            array(10, LengthConverter::M, LengthConverter::MM, 10000),
            array(10, LengthConverter::M, LengthConverter::IN, 393.70079),
            array(10, LengthConverter::M, LengthConverter::FT, 32.8084),
            array(10, LengthConverter::M, LengthConverter::YD, 10.93613),
            array(10, LengthConverter::M, LengthConverter::MI, 0.00621),

            // KM
            array(10, LengthConverter::KM, LengthConverter::M, 10000),
            array(10, LengthConverter::KM, LengthConverter::KM, 10),
            array(10, LengthConverter::KM, LengthConverter::DM, 100000),
            array(10, LengthConverter::KM, LengthConverter::CM, 1000000),
            array(10, LengthConverter::KM, LengthConverter::MM, 10000000),
            array(10, LengthConverter::KM, LengthConverter::IN, 393700.79),
            array(10, LengthConverter::KM, LengthConverter::FT, 32808.4),
            array(10, LengthConverter::KM, LengthConverter::YD, 10936.13),
            array(10, LengthConverter::KM, LengthConverter::MI, 6.21),

            // DM
            array(10, LengthConverter::DM, LengthConverter::M, 1),
            array(10, LengthConverter::DM, LengthConverter::KM, 0.001),
            array(10, LengthConverter::DM, LengthConverter::DM, 10),
            array(10, LengthConverter::DM, LengthConverter::CM, 100),
            array(10, LengthConverter::DM, LengthConverter::MM, 1000),
            array(10, LengthConverter::DM, LengthConverter::IN, 39.370079),
            array(10, LengthConverter::DM, LengthConverter::FT, 3.28084),
            array(10, LengthConverter::DM, LengthConverter::YD, 1.093613),
            array(10, LengthConverter::DM, LengthConverter::MI, 0.000621),

            // CM
            array(10, LengthConverter::CM, LengthConverter::M, 0.1),
            array(10, LengthConverter::CM, LengthConverter::KM, 0.0001),
            array(10, LengthConverter::CM, LengthConverter::DM, 1),
            array(10, LengthConverter::CM, LengthConverter::CM, 10),
            array(10, LengthConverter::CM, LengthConverter::MM, 100),
            array(10, LengthConverter::CM, LengthConverter::IN, 3.9370079),
            array(10, LengthConverter::CM, LengthConverter::FT, 0.328084),
            array(10, LengthConverter::CM, LengthConverter::YD, 0.1093613),
            array(10, LengthConverter::CM, LengthConverter::MI, 6.21E-5),

            // MM
            array(10, LengthConverter::MM, LengthConverter::M, 0.01),
            array(10, LengthConverter::MM, LengthConverter::KM, 0.00001),
            array(10, LengthConverter::MM, LengthConverter::DM, 0.1),
            array(10, LengthConverter::MM, LengthConverter::CM, 1),
            array(10, LengthConverter::MM, LengthConverter::MM, 10),
            array(10, LengthConverter::MM, LengthConverter::IN, 0.39370079),
            array(10, LengthConverter::MM, LengthConverter::FT, 0.0328084),
            array(10, LengthConverter::MM, LengthConverter::YD, 0.01093613),
            array(10, LengthConverter::MM, LengthConverter::MI, 6.21E-6),

            // IN
            array(10, LengthConverter::IN, LengthConverter::M,  0.2539999983236),
            array(10, LengthConverter::IN, LengthConverter::KM, 0.0002539999983236),
            array(10, LengthConverter::IN, LengthConverter::DM, 2.539999983236),
            array(10, LengthConverter::IN, LengthConverter::CM, 25.39999983236),
            array(10, LengthConverter::IN, LengthConverter::MM, 253.9999983236),
            array(10, LengthConverter::IN, LengthConverter::IN, 10),
            array(10, LengthConverter::IN, LengthConverter::FT, 0.8333333545),
            array(10, LengthConverter::IN, LengthConverter::YD, 0.27777770016667),
            array(10, LengthConverter::IN, LengthConverter::MI, 0.00015773399895896),

            // FT
            array(10, LengthConverter::FT, LengthConverter::M, 3.047999902464),
            array(10, LengthConverter::FT, LengthConverter::KM, 0.003047999902464),
            array(10, LengthConverter::FT, LengthConverter::DM, 30.47999902464),
            array(10, LengthConverter::FT, LengthConverter::CM, 304.7999902464),
            array(10, LengthConverter::FT, LengthConverter::MM, 3047.999902464),
            array(10, LengthConverter::FT, LengthConverter::IN, 119.999996952),
            array(10, LengthConverter::FT, LengthConverter::FT, 10),
            array(10, LengthConverter::FT, LengthConverter::YD, 3.3333323173334),
            array(10, LengthConverter::FT, LengthConverter::MI, 0.0018928079394301),

            // YD
            array(10, LengthConverter::YD, LengthConverter::M, 9.1440024944839),
            array(10, LengthConverter::YD, LengthConverter::KM, 0.0091440024944839),
            array(10, LengthConverter::YD, LengthConverter::DM, 91.440024944839),
            array(10, LengthConverter::YD, LengthConverter::CM, 914.40024944839),
            array(10, LengthConverter::YD, LengthConverter::MM, 9144.0024944839),
            array(10, LengthConverter::YD, LengthConverter::IN, 360.00010058403),
            array(10, LengthConverter::YD, LengthConverter::FT, 30.000009144002),
            array(10, LengthConverter::YD, LengthConverter::YD, 10),
            array(10, LengthConverter::YD, LengthConverter::MI, 0.0056784255490745),

            // MI
            array(10, LengthConverter::MI, LengthConverter::M, 16103.05958132),
            array(10, LengthConverter::MI, LengthConverter::KM, 16.10305958132),
            array(10, LengthConverter::MI, LengthConverter::DM, 161030.5958132),
            array(10, LengthConverter::MI, LengthConverter::CM, 1610305.958132),
            array(10, LengthConverter::MI, LengthConverter::MM, 16103059.58132),
            array(10, LengthConverter::MI, LengthConverter::IN, 633978.72785829),
            array(10, LengthConverter::MI, LengthConverter::FT, 52831.561996779),
            array(10, LengthConverter::MI, LengthConverter::YD, 17610.515297907),
            array(10, LengthConverter::MI, LengthConverter::MI, 10),
        );
    }
}