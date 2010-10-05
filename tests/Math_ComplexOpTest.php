<?php
require_once 'PHPUnit/Framework.php';
require_once 'Math/ComplexOp.php';

/**
 * Unit test for Math_ComplexOp
 *
 * @package Math_ComplexOp
 * @author Jesus M. Castagnetto
 * @version 0.8.2
 */
class Math_ComplexOpTest extends PHPUnit_Framework_TestCase { /*{{{*/

    var $cnum1;
    var $cnum2;
    var $im;

    function setUp() { /*{{{*/
        $this->cnum1 = new Math_Complex(0.3,0.5);
        $this->cnum2 = new Math_Complex(1,-M_PI_2);
        $this->im = -1.2;
    } /*}}}*/

    function tearDown() { /*{{{*/
        unset($this->cnum);
    } /*}}}*/

    // test of Math_ComplexOp::isComplex
    function testIsComplex() { /*{{{*/
        $this->assertEquals(true, Math_ComplexOp::isComplex($this->cnum1));
    } /*}}}*/

    // test of Math_ComplexOp::createFromPolar
    function testCreateFromPolar() { /*{{{*/
        $c1 = Math_ComplexOp::createFromPolar(0.022, -0.223);
        $this->assertEquals('0.021455244138 - 0.0048654392381i', $c1->toString());
    } /*}}}*/

    // test of Math_ComplexOp::sqrt
    function testSqrt() { /*{{{*/
        $tmp = Math_ComplexOp::sqrt($this->cnum1);
        $this->assertEquals('0.664490477541 + 0.3762281153i', $tmp->toString());
    } /*}}}*/

    // test of Math_ComplexOp::sqrtReal
    function testSqrtReal() { /*{{{*/
        $tmp = Math_ComplexOp::sqrtReal(-2.3);
        $this->assertEquals('0 + 1.51657508881i', $tmp->toString());
    } /*}}}*/

    // test of Math_ComplexOp::exp
    function testExp() { /*{{{*/
        $tmp = Math_ComplexOp::exp($this->cnum1);
        $this->assertEquals('1.18461255054 + 0.647156785862i', $tmp->toString());
    } /*}}}*/

    // test of Math_ComplexOp::log
    function testLog() { /*{{{*/
        $tmp = Math_ComplexOp::log($this->cnum1);
        $this->assertEquals('-0.539404830686 + 1.03037682652i', $tmp->toString());
    } /*}}}*/

    // test of Math_ComplexOp::log10
    function testLog10() { /*{{{*/
        $tmp = Math_ComplexOp::log10($this->cnum1);
        $this->assertEquals('-0.234260541479 + 0.44748697004i', $tmp->toString());
    } /*}}}*/

    // test of Math_ComplexOp::conjugate
    function testConjugate() { /*{{{*/
        $tmp = Math_ComplexOp::conjugate($this->cnum1);
        $this->assertEquals('0.3 - 0.5i', $tmp->toString());
    } /*}}}*/

    // test of Math_ComplexOp::negative
    function testNegative() { /*{{{*/
        $tmp = Math_ComplexOp::negative($this->cnum1);
        $this->assertEquals('-0.3 - 0.5i', $tmp->toString());
    } /*}}}*/

    // test of Math_ComplexOp::inverse
    function testInverse() { /*{{{*/
        $tmp = Math_ComplexOp::inverse($this->cnum1);
        $this->assertEquals('0.882352941176 - 1.47058823529i', $tmp->toString());
    } /*}}}*/

    // test of Math_ComplexOp::sin
    function testSin() { /*{{{*/
        $tmp = Math_ComplexOp::sin($this->cnum1);
        $this->assertEquals('0.333236258274 + 0.49782135965i', $tmp->toString());
    } /*}}}*/

    // test of Math_ComplexOp::cos
    function testCos() { /*{{{*/
        $tmp = Math_ComplexOp::cos($this->cnum1);
        $this->assertEquals('1.07726223065 + 0.15399419237i', $tmp->toString());
    } /*}}}*/

    // test of Math_ComplexOp::tan
    function testTan() { /*{{{*/
        $tmp = Math_ComplexOp::tan($this->cnum1);
        $this->assertEquals('0.238405083338 + 0.496197065774i', $tmp->toString());
    } /*}}}*/

    // test of Math_ComplexOp::sec
    function testSec() { /*{{{*/
        $tmp = Math_ComplexOp::sec($this->cnum1);
        $this->assertEquals('0.909689950635 - 0.13003980393i', $tmp->toString());
    } /*}}}*/

    // test of Math_ComplexOp::csc
    function testCsc() { /*{{{*/
        $tmp = Math_ComplexOp::csc($this->cnum1);
        $this->assertEquals('0.928564459614 - 1.38718164764i', $tmp->toString());
    } /*}}}*/

    // test of Math_ComplexOp::cot
    function testCot() { /*{{{*/
        $tmp = Math_ComplexOp::cot($this->cnum1);
        $this->assertEquals('0.786689503564 - 1.63735193007i', $tmp->toString());
    } /*}}}*/

    // test of Math_ComplexOp::asin
    function testAsin() { /*{{{*/
        $tmp = Math_ComplexOp::asin($this->cnum1);
        $this->assertEquals('0.269555641425 + 0.49790294283i', $tmp->toString());
    } /*}}}*/

    // test of Math_ComplexOp::asinAlt
    function testAsinAlt() { /*{{{*/
        if (!function_exists('log1p')) {
            $this->markTestSkipped("Your php installation appears broken?");
        }
        $tmp = Math_ComplexOp::asinAlt($this->cnum1);
        $this->assertEquals('0.269555641425 + 0.49790294283i', $tmp->toString());
    } /*}}}*/

    // test of Math_ComplexOp::asinReal
    function testAsinReal() { /*{{{*/
        $tmp = Math_ComplexOp::asinReal(-0.22);
        $this->assertEquals('-0.221814470497 + 0i', $tmp->toString());
    } /*}}}*/

    // test of Math_ComplexOp::acos
    function testAcos() { /*{{{*/
        $tmp = Math_ComplexOp::acos($this->cnum1);
        $this->assertEquals('1.30124068537 - 0.49790294283i', $tmp->toString());
    } /*}}}*/

    // test of Math_ComplexOp::atan
    function testAtan() { /*{{{*/
        $tmp = Math_ComplexOp::atan($this->cnum1);
        $this->assertEquals('0.36890753006 + 0.482240147685i', $tmp->toString());
    } /*}}}*/

    // test of Math_ComplexOp::asec
    function testAsec() { /*{{{*/
        $tmp = Math_ComplexOp::asec($this->cnum1);
        $this->assertEquals('1.09650722473 + 1.27677222662i', $tmp->toString());
    } /*}}}*/

    // test of Math_ComplexOp::acsc
    function testAcsc() { /*{{{*/
        $tmp = Math_ComplexOp::acsc($this->cnum1);
        $this->assertEquals('0.474289102066 - 1.27677222662i', $tmp->toString());
    } /*}}}*/

    // test of Math_ComplexOp::acot
    function testAcot() { /*{{{*/
        $tmp = Math_ComplexOp::acot($this->cnum1);
        $this->assertEquals('1.20188879673 - 0.482240147685i', $tmp->toString());
    } /*}}}*/

    // test of Math_ComplexOp::sinh
    function testSinh() { /*{{{*/
        $tmp = Math_ComplexOp::sinh($this->cnum1);
        $this->assertEquals('0.267241699271 + 0.50116198016i', $tmp->toString());
    } /*}}}*/

    // test of Math_ComplexOp::cosh
    function testCosh() { /*{{{*/
        $tmp = Math_ComplexOp::cosh($this->cnum1);
        $this->assertEquals('0.917370851272 + 0.145994805702i', $tmp->toString());
    } /*}}}*/

    // test of Math_ComplexOp::tanh
    function testTanh() { /*{{{*/
        $tmp = Math_ComplexOp::tanh($this->cnum1);
        $this->assertEquals('0.368910396826 + 0.487592316492i', $tmp->toString());
    } /*}}}*/

    // test of Math_ComplexOp::sech
    function testSech() { /*{{{*/
        $tmp = Math_ComplexOp::sech($this->cnum1);
        $this->assertEquals('1.06314534079 - 0.169194058484i', $tmp->toString());
    } /*}}}*/

    // test of Math_ComplexOp::csch
    function testCsch() { /*{{{*/
        $tmp = Math_ComplexOp::csch($this->cnum1);
        $this->assertEquals('0.828447184875 - 1.55359823247i', $tmp->toString());
    } /*}}}*/

    // test of Math_ComplexOp::coth
    function testCoth() { /*{{{*/
        $tmp = Math_ComplexOp::coth($this->cnum1);
        $this->assertEquals('0.98681057131 - 1.30427674727i', $tmp->toString());
    } /*}}}*/

    // test of Math_ComplexOp::asinh
    function testAsinh() { /*{{{*/
        $tmp = Math_ComplexOp::asinh($this->cnum1);
        $this->assertEquals('0.334299817775 + 0.493039240586i', $tmp->toString());
    } /*}}}*/

    // test of Math_ComplexOp::acosh
    function testAcosh() { /*{{{*/
        $tmp = Math_ComplexOp::acosh($this->cnum1);
        $this->assertEquals('-0.49790294283 - 1.30124068537i', $tmp->toString());
    } /*}}}*/

    // test of Math_ComplexOp::atanh
    function testAtanh() { /*{{{*/
        $tmp = Math_ComplexOp::atanh($this->cnum1);
        $this->assertEquals('0.240948266465 + 0.493711659901i', $tmp->toString());
    } /*}}}*/

    // test of Math_ComplexOp::asech
    function testAsech() { /*{{{*/
        $tmp = Math_ComplexOp::asech($this->cnum1);
        $this->assertEquals('-1.27677222662 + 1.09650722473i', $tmp->toString());
    } /*}}}*/

    // test of Math_ComplexOp::acsch
    function testAcsch() { /*{{{*/
        $tmp = Math_ComplexOp::acsch($this->cnum1);
        $this->assertEquals('1.20069954613 - 0.947077300711i', $tmp->toString());
    } /*}}}*/

    // test of Math_ComplexOp::acoth
    function testAcoth() { /*{{{*/
        $tmp = Math_ComplexOp::acoth($this->cnum1);
        $this->assertEquals('0.240948266465 - 1.07708466689i', $tmp->toString());
    } /*}}}*/

    // test of Math_ComplexOp::areEqual
    function testAreEqual() { /*{{{*/
        $this->assertFalse(Math_ComplexOp::areEqual($this->cnum1, $this->cnum2));
    } /*}}}*/

    // test of Math_ComplexOp::add
    function testAdd() { /*{{{*/
        $tmp = Math_ComplexOp::add($this->cnum1, $this->cnum2);
        $this->assertEquals('1.3 - 1.07079632679i', $tmp->toString());
    } /*}}}*/

    // test of Math_ComplexOp::sub
    function testSub() { /*{{{*/
        $tmp = Math_ComplexOp::sub($this->cnum1, $this->cnum2);
        $this->assertEquals('-0.7 + 2.07079632679i', $tmp->toString());
    } /*}}}*/

    // test of Math_ComplexOp::mult
    function testMult() { /*{{{*/
        $tmp = Math_ComplexOp::mult($this->cnum1, $this->cnum2);
        $this->assertEquals('1.0853981634 + 0.0287611019615i', $tmp->toString());
    } /*}}}*/

    // test of Math_ComplexOp::div
    function testDiv() { /*{{{*/
        $tmp = Math_ComplexOp::div($this->cnum1, $this->cnum2);
        $this->assertEquals('-0.139989043483 + 0.280105724706i', $tmp->toString());
    } /*}}}*/

    // test of Math_ComplexOp::pow
    function testPow() { /*{{{*/
        $tmp = Math_ComplexOp::pow($this->cnum1, $this->cnum2);
        $this->assertEquals('-0.8887400946 + 2.80460534274i', $tmp->toString());
    } /*}}}*/

    // test of Math_ComplexOp::logBase
    function testLogBase() { /*{{{*/
        $tmp = Math_ComplexOp::logBase($this->cnum1, $this->cnum2);
        $this->assertEquals('-0.982378335118 + 0.0710663285296i', $tmp->toString());
    } /*}}}*/

    // test of Math_ComplexOp::multReal
    function testMultReal() { /*{{{*/
        $tmp = Math_ComplexOp::multReal($this->cnum1, M_PI);
        $this->assertEquals('0.942477796077 + 1.57079632679i', $tmp->toString());
    } /*}}}*/

    // test of Math_ComplexOp::multIm
    function testMultIm() { /*{{{*/
        $tmp = Math_ComplexOp::multIm($this->cnum1, $this->im);
        $this->assertEquals('0.6 - 0.36i', $tmp->toString());
    } /*}}}*/

    // test of Math_ComplexOp::powReal
    function testPowReal() { /*{{{*/
        $tmp = Math_ComplexOp::powReal($this->cnum1, M_E);
        $this->assertEquals('-0.217519902849 + 0.0771254874156i', $tmp->toString());
    } /*}}}*/

}/*}}}*/
