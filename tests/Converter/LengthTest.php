<?php

namespace Moriony\Trivial\Math;

use Moriony\Trivial\Converter\Length;
use Moriony\Trivial\Converter\UnitConverterInterface;

class LengthTest extends \PHPUnit_Framework_TestCase
{
    /** @var UnitConverterInterface */
    protected $converter;

    public function setUp()
    {
        $this->converter = new Length(new Native());
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
            array('invalid unit', Length::CM),
            array(Length::CM, 'invalid unit'),
            array('invalid unit', 'invalid unit'),
        );
    }

    public function provideConvertData()
    {
        return array(
            // M
            array(10, Length::M, Length::M, 10),
            array(10, Length::M, Length::KM, 0.01),
            array(10, Length::M, Length::DM, 100),
            array(10, Length::M, Length::CM, 1000),
            array(10, Length::M, Length::MM, 10000),
            array(10, Length::M, Length::IN, 393.70079),
            array(10, Length::M, Length::FT, 32.8084),
            array(10, Length::M, Length::YD, 10.93613),
            array(10, Length::M, Length::MI, 0.00621),

            // KM
            array(10, Length::KM, Length::M, 10000),
            array(10, Length::KM, Length::KM, 10),
            array(10, Length::KM, Length::DM, 100000),
            array(10, Length::KM, Length::CM, 1000000),
            array(10, Length::KM, Length::MM, 10000000),
            array(10, Length::KM, Length::IN, 393700.79),
            array(10, Length::KM, Length::FT, 32808.4),
            array(10, Length::KM, Length::YD, 10936.13),
            array(10, Length::KM, Length::MI, 6.21),

            // DM
            array(10, Length::DM, Length::M, 1),
            array(10, Length::DM, Length::KM, 0.001),
            array(10, Length::DM, Length::DM, 10),
            array(10, Length::DM, Length::CM, 100),
            array(10, Length::DM, Length::MM, 1000),
            array(10, Length::DM, Length::IN, 39.370079),
            array(10, Length::DM, Length::FT, 3.28084),
            array(10, Length::DM, Length::YD, 1.093613),
            array(10, Length::DM, Length::MI, 0.000621),

            // CM
            array(10, Length::CM, Length::M, 0.1),
            array(10, Length::CM, Length::KM, 0.0001),
            array(10, Length::CM, Length::DM, 1),
            array(10, Length::CM, Length::CM, 10),
            array(10, Length::CM, Length::MM, 100),
            array(10, Length::CM, Length::IN, 3.9370079),
            array(10, Length::CM, Length::FT, 0.328084),
            array(10, Length::CM, Length::YD, 0.1093613),
            array(10, Length::CM, Length::MI, 6.21E-5),

            // MM
            array(10, Length::MM, Length::M, 0.01),
            array(10, Length::MM, Length::KM, 0.00001),
            array(10, Length::MM, Length::DM, 0.1),
            array(10, Length::MM, Length::CM, 1),
            array(10, Length::MM, Length::MM, 10),
            array(10, Length::MM, Length::IN, 0.39370079),
            array(10, Length::MM, Length::FT, 0.0328084),
            array(10, Length::MM, Length::YD, 0.01093613),
            array(10, Length::MM, Length::MI, 6.21E-6),

            // IN
            array(10, Length::IN, Length::M,  0.2539999983236),
            array(10, Length::IN, Length::KM, 0.0002539999983236),
            array(10, Length::IN, Length::DM, 2.539999983236),
            array(10, Length::IN, Length::CM, 25.39999983236),
            array(10, Length::IN, Length::MM, 253.9999983236),
            array(10, Length::IN, Length::IN, 10),
            array(10, Length::IN, Length::FT, 0.8333333545),
            array(10, Length::IN, Length::YD, 0.27777770016667),
            array(10, Length::IN, Length::MI, 0.00015773399895896),

            // FT
            array(10, Length::FT, Length::M, 3.047999902464),
            array(10, Length::FT, Length::KM, 0.003047999902464),
            array(10, Length::FT, Length::DM, 30.47999902464),
            array(10, Length::FT, Length::CM, 304.7999902464),
            array(10, Length::FT, Length::MM, 3047.999902464),
            array(10, Length::FT, Length::IN, 119.999996952),
            array(10, Length::FT, Length::FT, 10),
            array(10, Length::FT, Length::YD, 3.3333323173334),
            array(10, Length::FT, Length::MI, 0.0018928079394301),

            // YD
            array(10, Length::YD, Length::M, 9.1440024944839),
            array(10, Length::YD, Length::KM, 0.0091440024944839),
            array(10, Length::YD, Length::DM, 91.440024944839),
            array(10, Length::YD, Length::CM, 914.40024944839),
            array(10, Length::YD, Length::MM, 9144.0024944839),
            array(10, Length::YD, Length::IN, 360.00010058403),
            array(10, Length::YD, Length::FT, 30.000009144002),
            array(10, Length::YD, Length::YD, 10),
            array(10, Length::YD, Length::MI, 0.0056784255490745),

            // MI
            array(10, Length::MI, Length::M, 16103.05958132),
            array(10, Length::MI, Length::KM, 16.10305958132),
            array(10, Length::MI, Length::DM, 161030.5958132),
            array(10, Length::MI, Length::CM, 1610305.958132),
            array(10, Length::MI, Length::MM, 16103059.58132),
            array(10, Length::MI, Length::IN, 633978.72785829),
            array(10, Length::MI, Length::FT, 52831.561996779),
            array(10, Length::MI, Length::YD, 17610.515297907),
            array(10, Length::MI, Length::MI, 10),
        );
    }
}