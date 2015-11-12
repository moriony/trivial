<?php

namespace Moriony\Trivial\Math;

use Moriony\Trivial\Converter\LengthConverter;
use Moriony\Trivial\Converter\UnitConverterInterface;
use Moriony\Trivial\Unit\LengthUnits;

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
            array('invalid unit', LengthUnits::CM),
            array(LengthUnits::CM, 'invalid unit'),
            array('invalid unit', 'invalid unit'),
        );
    }

    public function provideConvertData()
    {
        return array(
            // M
            array(10, LengthUnits::M, LengthUnits::M, 10),
            array(10, LengthUnits::M, LengthUnits::KM, 0.01),
            array(10, LengthUnits::M, LengthUnits::DM, 100),
            array(10, LengthUnits::M, LengthUnits::CM, 1000),
            array(10, LengthUnits::M, LengthUnits::MM, 10000),
            array(10, LengthUnits::M, LengthUnits::IN, 393.70079),
            array(10, LengthUnits::M, LengthUnits::FT, 32.8084),
            array(10, LengthUnits::M, LengthUnits::YD, 10.93613),
            array(10, LengthUnits::M, LengthUnits::MI, 0.00621),

            // KM
            array(10, LengthUnits::KM, LengthUnits::M, 10000),
            array(10, LengthUnits::KM, LengthUnits::KM, 10),
            array(10, LengthUnits::KM, LengthUnits::DM, 100000),
            array(10, LengthUnits::KM, LengthUnits::CM, 1000000),
            array(10, LengthUnits::KM, LengthUnits::MM, 10000000),
            array(10, LengthUnits::KM, LengthUnits::IN, 393700.79),
            array(10, LengthUnits::KM, LengthUnits::FT, 32808.4),
            array(10, LengthUnits::KM, LengthUnits::YD, 10936.13),
            array(10, LengthUnits::KM, LengthUnits::MI, 6.21),

            // DM
            array(10, LengthUnits::DM, LengthUnits::M, 1),
            array(10, LengthUnits::DM, LengthUnits::KM, 0.001),
            array(10, LengthUnits::DM, LengthUnits::DM, 10),
            array(10, LengthUnits::DM, LengthUnits::CM, 100),
            array(10, LengthUnits::DM, LengthUnits::MM, 1000),
            array(10, LengthUnits::DM, LengthUnits::IN, 39.370079),
            array(10, LengthUnits::DM, LengthUnits::FT, 3.28084),
            array(10, LengthUnits::DM, LengthUnits::YD, 1.093613),
            array(10, LengthUnits::DM, LengthUnits::MI, 0.000621),

            // CM
            array(10, LengthUnits::CM, LengthUnits::M, 0.1),
            array(10, LengthUnits::CM, LengthUnits::KM, 0.0001),
            array(10, LengthUnits::CM, LengthUnits::DM, 1),
            array(10, LengthUnits::CM, LengthUnits::CM, 10),
            array(10, LengthUnits::CM, LengthUnits::MM, 100),
            array(10, LengthUnits::CM, LengthUnits::IN, 3.9370079),
            array(10, LengthUnits::CM, LengthUnits::FT, 0.328084),
            array(10, LengthUnits::CM, LengthUnits::YD, 0.1093613),
            array(10, LengthUnits::CM, LengthUnits::MI, 6.21E-5),

            // MM
            array(10, LengthUnits::MM, LengthUnits::M, 0.01),
            array(10, LengthUnits::MM, LengthUnits::KM, 0.00001),
            array(10, LengthUnits::MM, LengthUnits::DM, 0.1),
            array(10, LengthUnits::MM, LengthUnits::CM, 1),
            array(10, LengthUnits::MM, LengthUnits::MM, 10),
            array(10, LengthUnits::MM, LengthUnits::IN, 0.39370079),
            array(10, LengthUnits::MM, LengthUnits::FT, 0.0328084),
            array(10, LengthUnits::MM, LengthUnits::YD, 0.01093613),
            array(10, LengthUnits::MM, LengthUnits::MI, 6.21E-6),

            // IN
            array(10, LengthUnits::IN, LengthUnits::M,  0.2539999983236),
            array(10, LengthUnits::IN, LengthUnits::KM, 0.0002539999983236),
            array(10, LengthUnits::IN, LengthUnits::DM, 2.539999983236),
            array(10, LengthUnits::IN, LengthUnits::CM, 25.39999983236),
            array(10, LengthUnits::IN, LengthUnits::MM, 253.9999983236),
            array(10, LengthUnits::IN, LengthUnits::IN, 10),
            array(10, LengthUnits::IN, LengthUnits::FT, 0.8333333545),
            array(10, LengthUnits::IN, LengthUnits::YD, 0.27777770016667),
            array(10, LengthUnits::IN, LengthUnits::MI, 0.00015773399895896),

            // FT
            array(10, LengthUnits::FT, LengthUnits::M, 3.047999902464),
            array(10, LengthUnits::FT, LengthUnits::KM, 0.003047999902464),
            array(10, LengthUnits::FT, LengthUnits::DM, 30.47999902464),
            array(10, LengthUnits::FT, LengthUnits::CM, 304.7999902464),
            array(10, LengthUnits::FT, LengthUnits::MM, 3047.999902464),
            array(10, LengthUnits::FT, LengthUnits::IN, 119.999996952),
            array(10, LengthUnits::FT, LengthUnits::FT, 10),
            array(10, LengthUnits::FT, LengthUnits::YD, 3.3333323173334),
            array(10, LengthUnits::FT, LengthUnits::MI, 0.0018928079394301),

            // YD
            array(10, LengthUnits::YD, LengthUnits::M, 9.1440024944839),
            array(10, LengthUnits::YD, LengthUnits::KM, 0.0091440024944839),
            array(10, LengthUnits::YD, LengthUnits::DM, 91.440024944839),
            array(10, LengthUnits::YD, LengthUnits::CM, 914.40024944839),
            array(10, LengthUnits::YD, LengthUnits::MM, 9144.0024944839),
            array(10, LengthUnits::YD, LengthUnits::IN, 360.00010058403),
            array(10, LengthUnits::YD, LengthUnits::FT, 30.000009144002),
            array(10, LengthUnits::YD, LengthUnits::YD, 10),
            array(10, LengthUnits::YD, LengthUnits::MI, 0.0056784255490745),

            // MI
            array(10, LengthUnits::MI, LengthUnits::M, 16103.05958132),
            array(10, LengthUnits::MI, LengthUnits::KM, 16.10305958132),
            array(10, LengthUnits::MI, LengthUnits::DM, 161030.5958132),
            array(10, LengthUnits::MI, LengthUnits::CM, 1610305.958132),
            array(10, LengthUnits::MI, LengthUnits::MM, 16103059.58132),
            array(10, LengthUnits::MI, LengthUnits::IN, 633978.72785829),
            array(10, LengthUnits::MI, LengthUnits::FT, 52831.561996779),
            array(10, LengthUnits::MI, LengthUnits::YD, 17610.515297907),
            array(10, LengthUnits::MI, LengthUnits::MI, 10),
        );
    }
}