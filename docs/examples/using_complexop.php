<?php

/*
 * To test Math_Complex and Math_ComplexOp
 * $Id$
 */

require_once 'Math/ComplexOp.php';

$a = new Math_Complex(0.3,0.5);
$b = new Math_Complex(1.0,-M_PI_2);
$im = -1.2;
echo "a = ".$a->toString()."\n";
echo "b = ".$b->toString()."\n";
echo "im = {$im}i\n";
$z = Math_ComplexOp::createFromPolar(0.022, -0.223);
echo "from polar, z = ".$z->toString()."\n";
$z = Math_ComplexOp::sqrt($a);
echo "sqrt(a) = ".$z->toString()."\n";
$z = Math_ComplexOp::sqrtReal(-2.3);
echo "sqrtReal(a) = ".$z->toString()."\n";
$z = Math_ComplexOp::exp($a);
echo "exp(a) = ".$z->toString()."\n";
$z = Math_ComplexOp::log($a);
echo "log(a) = ".$z->toString()."\n";
$z = Math_ComplexOp::log10($a);
echo "log10(a) = ".$z->toString()."\n";
$z = Math_ComplexOp::conjugate($a);
echo "conjugate(a) = ".$z->toString()."\n";
$z = Math_ComplexOp::negative($a);
echo "negative(a) = ".$z->toString()."\n";
$z = Math_ComplexOp::inverse($a);
echo "inverse(a) = ".$z->toString()."\n";
$z = Math_ComplexOp::sin($a);
echo "sin(a) = ".$z->toString()."\n";
$z = Math_ComplexOp::cos($a);
echo "cos(a) = ".$z->toString()."\n";
$z = Math_ComplexOp::tan($a);
echo "tan(a) = ".$z->toString()."\n";
$z = Math_ComplexOp::sec($a);
echo "sec(a) = ".$z->toString()."\n";
$z = Math_ComplexOp::csc($a);
echo "csc(a) = ".$z->toString()."\n";
$z = Math_ComplexOp::cot($a);
echo "cot(a) = ".$z->toString()."\n";
$z = Math_ComplexOp::asin($a);
echo "asin(a) = ".$z->toString()."\n";
$z = Math_ComplexOp::asinAlt($a);
echo "asinAlt(a) = ".$z->toString()."\n";
$z = Math_ComplexOp::asinReal(-0.22);
echo "asinReal(a) = ".$z->toString()."\n";
$z = Math_ComplexOp::acos($a);
echo "acos(a) = ".$z->toString()."\n";
$z = Math_ComplexOp::atan($a);
echo "atan(a) = ".$z->toString()."\n";
$z = Math_ComplexOp::asec($a);
echo "asec(a) = ".$z->toString()."\n";
$z = Math_ComplexOp::acsc($a);
echo "acsc(a) = ".$z->toString()."\n";
$z = Math_ComplexOp::acot($a);
echo "acot(a) = ".$z->toString()."\n";
$z = Math_ComplexOp::sinh($a);
echo "sinh(a) = ".$z->toString()."\n";
$z = Math_ComplexOp::cosh($a);
echo "cosh(a) = ".$z->toString()."\n";
$z = Math_ComplexOp::tanh($a);
echo "tanh(a) = ".$z->toString()."\n";
$z = Math_ComplexOp::sech($a);
echo "sech(a) = ".$z->toString()."\n";
$z = Math_ComplexOp::csch($a);
echo "csch(a) = ".$z->toString()."\n";
$z = Math_ComplexOp::coth($a);
echo "coth(a) = ".$z->toString()."\n";
$z = Math_ComplexOp::asinh($a);
echo "asinh(a) = ".$z->toString()."\n";
$z = Math_ComplexOp::acosh($a);
echo "acosh(a) = ".$z->toString()."\n";
$z = Math_ComplexOp::atanh($a);
echo "atanh(a) = ".$z->toString()."\n";
$z = Math_ComplexOp::asech($a);
echo "asech(a) = ".$z->toString()."\n";
$z = Math_ComplexOp::acsch($a);
echo "acsch(a) = ".$z->toString()."\n";
$z = Math_ComplexOp::acoth($a);
echo "acoth(a) = ".$z->toString()."\n";
if (!Math_ComplexOp::areEqual($a, $b))
	echo "a != b\n";
$z = Math_ComplexOp::add($a, $b);
echo "add(a, b) = ".$z->toString()."\n";
$z = Math_ComplexOp::sub($a, $b);
echo "sub(a,b) = a - b = ".$z->toString()."\n";
$t=Math_ComplexOp::sub($b,$a);
echo "b - a: ".$t->toString()."\n";
$t=Math_ComplexOp::sub($b,Math_ComplexOp::conjugate($a));
echo "b - a': ".$t->toString()."\n";
$v=Math_ComplexOp::conjugate($b);
$t=Math_ComplexOp::sub($v,$a);
echo "b' - a: ".$t->toString()."\n";
$v=Math_ComplexOp::conjugate($b);
$t=Math_ComplexOp::sub($v,Math_ComplexOp::conjugate($a));
echo "b' - a': ".$t->toString()."\n";
$z = Math_ComplexOp::mult($a, $b);
echo "mult(a, b) = ".$z->toString()."\n";
$z = Math_ComplexOp::div($a, $b);
echo "div(a, b) = ".$z->toString()."\n";
$z = Math_ComplexOp::pow($a, $b);
echo "pow(a, b) = ".$z->toString()."\n";
$z = Math_ComplexOp::logBase($a, $b);
echo "logBase(a, b) = ".$z->toString()."\n";
$z = Math_ComplexOp::multReal($a, M_PI);
echo "multReal(a, M_PI) = ".$z->toString()."\n";
$z = Math_ComplexOp::multIm($a, $im);
echo "multIm(a, i) = ".$z->toString()."\n";
$z = Math_ComplexOp::powReal($a, M_E);
echo "powReal(a, M_E) = ".$z->toString()."\n";

?>
