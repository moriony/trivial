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
}