<?php

// uses PHPUnit 0.6.2
require_once 'PHPUnit/Framework.php';
require_once 'Math/Complex.php';

/**
 * Unit test for Math_Complex
 *
 * @package Math_Complex
 * @author Jesus M. Castagnetto
 * @version 0.8.2
 */
class Math_Complex_UnitTest extends PHPUnit_Framework_TestCase { /*{{{*/

    var $o1 = null;

    function setUp() { /*{{{*/
        // set up your test vars and data
        $this->o1 = new Math_Complex(3,2);
    } /*}}}*/

    function testToString() { /*{{{*/
        // test of Math_Complex::toString
        $this->assertEquals("3 + 2i", $this->o1->toString());
    } /*}}}*/

    function testAbs2() { /*{{{*/
        // test of Math_Complex::abs2
        $this->assertEquals(13, $this->o1->abs2());
    } /*}}}*/

    function testAbs() { /*{{{*/
        // test of Math_Complex::abs
        $this->assertEquals(strval(3.60555127546), strval($this->o1->abs()));
    } /*}}}*/

    function testNorm() { /*{{{*/
        // test of Math_Complex::norm
        $this->assertEquals(strval(3.60555127546), strval($this->o1->norm()));
    } /*}}}*/

    function testArg() { /*{{{*/
        // test of Math_Complex::arg
        $this->assertEquals(strval(0.588002603548), strval($this->o1->arg()));
    } /*}}}*/

    function testAngle() { /*{{{*/
        // test of Math_Complex::angle
        $this->assertEquals(strval(0.588002603548), strval($this->o1->angle()));
    } /*}}}*/

    function testGetReal() { /*{{{*/
        // test of Math_Complex::getReal
        $this->assertEquals(3, $this->o1->getReal());
    } /*}}}*/

    function testGetIm() { /*{{{*/
        // test of Math_Complex::getIm
        $this->assertEquals(2, $this->o1->getIm());
    } /*}}}*/

}/*}}}*/
