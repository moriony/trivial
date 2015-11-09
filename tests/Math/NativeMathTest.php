<?php

namespace Moriony\Trivial\Math;

class NativeTest extends \PHPUnit_Framework_TestCase
{
    /** @var NativeMath */
    protected $math;

    public function setUp()
    {
        $this->math = new NativeMath();
    }

    public function testInstanceOf()
    {
        $this->assertInstanceOf('Moriony\Trivial\Math\MathInterface', $this->math);
    }

    public function testMul()
    {
        $this->assertEquals(10, $this->math->mul(2, 5));
    }

    public function testDiv()
    {
        $this->assertEquals(2.5, $this->math->div(5, 2));
    }

    public function testSum()
    {
        $this->assertEquals(7, $this->math->sum(5, 2));
    }

    public function testSub()
    {
        $this->assertEquals(3, $this->math->sub(5, 2));
    }
    /**
     * @dataProvider provideRoundUpData
     */
    public function testRoundUp($a, $scale, $expected)
    {
        $this->assertEquals($expected, $this->math->roundUp($a, $scale));
    }
    /**
     * @dataProvider provideRoundDownData
     */
    public function testRoundDown($a, $scale, $expected)
    {
        $this->assertEquals($expected, $this->math->roundDown($a, $scale));
    }
    /**
     * @dataProvider provideRoundHalfUpData
     */
    public function testRoundHalfUp($a, $scale, $expected)
    {
        $this->assertEquals($expected, $this->math->roundHalfUp($a, $scale));
    }
    /**
     * @dataProvider provideRoundHalfDownData
     */
    public function testRoundHalfDown($a, $scale, $expected)
    {
        $this->assertEquals($expected, $this->math->roundHalfDown($a, $scale));
    }
    /**
     * @dataProvider provideEqualData
     */
    public function testEqualSuccess($a, $b)
    {
        $this->assertTrue($this->math->eq($a, $b));
    }
    /**
     * @dataProvider provideNotEqualData
     */
    public function testEqualFail($a, $b)
    {
        $this->assertFalse($this->math->eq($a, $b));
    }
    /**
     * @dataProvider provideGreaterThanData
     */
    public function testGreaterThanSuccess($a, $b)
    {
        $this->assertTrue($this->math->greaterThan($a, $b));
    }
    /**
     * @dataProvider provideLessOrEqualThanData
     */
    public function testGreaterThanFail($a, $b)
    {
        $this->assertFalse($this->math->greaterThan($a, $b));
    }
    /**
     * @dataProvider provideGreaterOrEqualThanData
     */
    public function testGreaterOrEqualThanSuccess($a, $b)
    {
        $this->assertTrue($this->math->greaterOrEqualThan($a, $b));
    }
    /**
     * @dataProvider provideLessThanData
     */
    public function testGreaterOrEqualThanFail($a, $b)
    {
        $this->assertFalse($this->math->greaterOrEqualThan($a, $b));
    }

    /**
     * @dataProvider provideLessThanData
     */
    public function testLessThanSuccess($a, $b)
    {
        $this->assertTrue($this->math->lessThan($a, $b));
    }
    /**
     * @dataProvider provideNotLessThanData
     */
    public function testLessThanFail($a, $b)
    {
        $this->assertFalse($this->math->lessThan($a, $b));
    }
    /**
     * @dataProvider provideLessOrEqualThanData
     */
    public function testLessOrEqualThanSuccess($a, $b)
    {
        $this->assertTrue($this->math->lessOrEqualThan($a, $b));
    }
    /**
     * @dataProvider provideGreaterThanData
     */
    public function testLessOrEqualThanFail($a, $b)
    {
        $this->assertFalse($this->math->lessOrEqualThan($a, $b));
    }
    /**
     * @dataProvider provideCompData
     */
    public function testComp($a, $b, $expected)
    {
        $this->assertSame($expected, $this->math->comp($a, $b));
    }
    /**
     * @dataProvider provideAbsData
     */
    public function testAbs($a, $expected)
    {
        $this->assertSame($expected, $this->math->abs($a));
    }
    /**
     * @dataProvider provideSqrtData
     */
    public function testSqrt($a, $expected)
    {
        $this->assertEquals($expected, $this->math->sqrt($a));
    }
    /**
     * @dataProvider providePowData
     */
    public function testPow($a, $b, $expected)
    {
        $this->assertEquals($expected, $this->math->pow($a, $b));
    }

    public function provideEqualData()
    {
        return array(
            array(1,1),
            array(1,'1')
        );
    }

    public function provideNotEqualData()
    {
        return array(
            array(1,2),
            array(1,'2')
        );
    }

    public function provideGreaterThanData()
    {
        return array(
            array(2,1),
            array(2,'1')
        );
    }

    public function provideGreaterOrEqualThanData()
    {
        return array(
            array(1,1),
            array(1,'1'),
            array(2,1),
            array(2,'1')
        );
    }

    public function provideLessThanData()
    {
        return array(
            array(1,2),
            array(1,'2')
        );
    }

    public function provideNotLessThanData()
    {
        return array(
            array(2,1),
            array(2,'1'),
            array(2,2),
            array(2,'2')
        );
    }

    public function provideLessOrEqualThanData()
    {
        return array(
            array(1,1),
            array(1,'1'),
            array(1,2),
            array(1,'2')
        );
    }

    public function provideCompData()
    {
        return array(
            array(1,1,0),
            array(1,'1',0),
            array(1,2,-1),
            array(1,'2',-1),
            array(2,1,1),
            array(2,'1',1)
        );
    }

    public function provideRoundUpData()
    {
        return array(
            array(1, 0, 1),
            array(0.1, 0, 1),
            array(1.1, 0, 2),
            array(0.01, 0, 1),
            array(1.01, 0, 2),
            array(0.001, 0, 1),
            array(1.001, 0, 2),
            array(100.001, 0, 101),

            array(1, 1, 1),
            array(0.1, 1, 0.1),
            array(1.1, 1, 1.1),
            array(0.01, 1, 0.1),
            array(1.01, 1, 1.1),
            array(0.001, 1, 0.1),
            array(1.001, 1, 1.1),
            array(100.001, 1, 100.1),

            array(1, -1, 10),
            array(0.1, -1, 10),
            array(1.1, -1, 10),
            array(0.01, -1, 10),
            array(1.01, -1, 10),
            array(0.001, -1, 10),
            array(1.001, -1, 10),
            array(100.001, -1, 110),
        );
    }

    public function provideRoundDownData()
    {
        return array(
            array(1, 0, 1),
            array(0.1, 0, 0),
            array(1.1, 0, 1),
            array(0.01, 0, 0),
            array(1.01, 0, 1),
            array(0.001, 0, 0),
            array(1.001, 0, 1),
            array(100.001, 0, 100),

            array(1, 1, 1),
            array(0.1, 1, 0.1),
            array(1.1, 1, 1.1),
            array(0.01, 1, 0),
            array(1.01, 1, 1),
            array(0.001, 1, 0),
            array(1.001, 1, 1),
            array(100.001, 1, 100),

            array(1, -1, 0),
            array(0.1, -1, 0),
            array(1.1, -1, 0),
            array(0.01, -1, 0),
            array(1.01, -1, 0),
            array(0.001, -1, 0),
            array(1.001, -1, 0),
            array(100.001, -1, 100),
            array(101.001, -1, 100),
        );
    }

    public function provideAbsData()
    {
        return array(
            array(1,1),
            array('1',1),
            array(-1,1),
            array('-1',1),
        );
    }

    public function provideSqrtData()
    {
        return array(
            array(1,1),
            array('1',1),
            array(9,3),
            array('9',3),
        );
    }


    public function providePowData()
    {
        return array(
            array(1,1,1),
            array(1,2,1),
            array(3,2,9),
            array(-3,2,9),
            array(5,-1,0.2),
        );
    }

    public function provideRoundHalfUpData()
    {
        return array(
            array(1, 0, 1),
            array(0.4, 0, 0),
            array(1.4, 0, 1),
            array(0.5, 0, 1),
            array(1.5, 0, 2),
            array(0.6, 0, 1),
            array(1.6, 0, 2),

            array(1, 1, 1),
            array(0.14, 1, 0.1),
            array(1.14, 1, 1.1),
            array(0.15, 1, 0.2),
            array(1.15, 1, 1.2),
            array(0.16, 1, 0.2),
            array(1.16, 1, 1.2),

            array(10, -1, 10),
            array(4, -1, 0),
            array(14, -1, 10),
            array(5, -1, 10),
            array(15, -1, 20),
            array(6, -1, 10),
            array(16, -1, 20),
        );
    }

    public function provideRoundHalfDownData()
    {
        return array(
            array(1, 0, 1),
            array(0.4, 0, 0),
            array(1.4, 0, 1),
            array(0.5, 0, 0),
            array(1.5, 0, 1),
            array(0.6, 0, 1),
            array(1.6, 0, 2),

            array(1, 1, 1),
            array(0.14, 1, 0.1),
            array(1.14, 1, 1.1),
            array(0.15, 1, 0.1),
            array(1.15, 1, 1.1),
            array(0.16, 1, 0.2),
            array(1.16, 1, 1.2),

            array(10, -1, 10),
            array(4, -1, 0),
            array(14, -1, 10),
            array(5, -1, 0),
            array(15, -1, 10),
            array(6, -1, 10),
            array(16, -1, 20),
        );
    }
}