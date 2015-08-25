<?php

namespace Moriony\Trivial\Math;

class NativeTest extends \PHPUnit_Framework_TestCase
{
    /** @var  MathInterface */
    protected $math;

    public function setUp()
    {
        $this->math = new Native();
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

    public function testCeil()
    {
        $this->assertEquals(3, $this->math->ceil(2.5));
    }

    public function testFloor()
    {
        $this->assertEquals(2, $this->math->floor(2.5));
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

    public function provideEqualData()
    {
        return [
            [1,1],
            [1,'1']
        ];
    }

    public function provideNotEqualData()
    {
        return [
            [1,2],
            [1,'2']
        ];
    }

    public function provideGreaterThanData()
    {
        return [
            [2,1],
            [2,'1']
        ];
    }

    public function provideGreaterOrEqualThanData()
    {
        return [
            [1,1],
            [1,'1'],
            [2,1],
            [2,'1']
        ];
    }

    public function provideLessThanData()
    {
        return [
            [1,2],
            [1,'2']
        ];
    }

    public function provideNotLessThanData()
    {
        return [
            [2,1],
            [2,'1'],
            [2,2],
            [2,'2']
        ];
    }

    public function provideLessOrEqualThanData()
    {
        return [
            [1,1],
            [1,'1'],
            [1,2],
            [1,'2']
        ];
    }
}