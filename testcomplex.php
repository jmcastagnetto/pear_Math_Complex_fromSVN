<?php

/*
 * To test class.complex.php
 * numPHP (c) Jesus M. Castagnetto 1999,2000.
 * $Id$
 */

require_once './ComplexOp.php';

$a = new Math_Complex(2.0,-1.0);
$b = new Math_Complex(1,-2);
$c = new Math_Complex (1.455347, -0.3435607);
echo "a: ".$a->toString()."\n";
echo "b: ".$b->toString()."\n";
echo "c: ".$c->toString()."\n";
echo "abs(a): ".$a->abs()."  arg(a): ".$a->arg()."\n";
echo "real(a): ".$a->getReal()."  imag(a): ".$a->getIm()."\n";
$d = Math_ComplexOp::sqrt($a);
echo "sqrt: ".$d->toString()."\n";
$e = Math_ComplexOp::exp($a);
echo "exp: ".$e->toString()."\n";
$e = Math_ComplexOp::log($a);
echo "log: ".$e->toString()."\n";
$e = Math_ComplexOp::log10($a);
echo "log10: ".$e->toString()."\n";
$e = Math_ComplexOp::conjugate($a);
echo "conjugate: ".$e->toString()."\n";
$e = Math_ComplexOp::negative($a);
echo "negative: ".$e->toString()."\n";
$e = Math_ComplexOp::multReal($a, M_PI);
echo "z * real: ".$e->toString()."\n";

if (!Math_ComplexOp::areEqual($a, Math_ComplexOp::negative($a))) {echo "a and neg(a) are different\n";}
echo "a is ".$a->toString()."\n";
$t=Math_ComplexOp::negative($a);
echo "Neg(a) is ".$t->toString()."\n";
$t=Math_ComplexOp::conjugate($a);
echo "Conj(a) is ".$t->toString()."\n";
$t=Math_ComplexOp::sin($a);
echo "Sin(a) is ".$t->toString()."\n";
$v = Math_ComplexOp::asin($t);
echo "ArcSin(Sin(a)) is ".$v->toString()."\n";
$t=Math_ComplexOp::cos($a);
echo "Cos(a) is ".$t->toString()."\n";
$v = Math_ComplexOp::acos($t);
echo "ArcCos(Cos(a)) is ".$v->toString()."\n";
$t=Math_ComplexOp::tan($a);
echo "Tan(a) is ".$t->toString()."\n";
$v = Math_ComplexOp::atan($t);
echo "ArcTan(Tan(a)) is ".$v->toString()."\n";
$foo = new Math_Complex(0.3, 0.5);
$sin = Math_ComplexOp::sin($foo);
$asin = Math_ComplexOp::asin($sin);
$tan = Math_ComplexOp::tan($foo);
$atan = Math_ComplexOp::atan($tan);
echo "foo is ".$foo->toString()."\n";
echo "sin(foo) is ".$sin->toString()."\n";
echo "asin(sin(foo)) is ".$asin->toString()."\n";
echo "tan(foo) is ".$tan->toString()."\n";
echo "atan(tan(foo)) is ".$atan->toString()."\n";
echo "====\n";
$h = Math_ComplexOp::sinh($foo);
echo "sinh(foo) is ".$h->toString()."\n";
$h = Math_ComplexOp::cosh($foo);
echo "cosh(foo) is ".$h->toString()."\n";
$h = Math_ComplexOp::tanh($foo);
echo "tanh(foo) is ".$h->toString()."\n";
$h = Math_ComplexOp::sech($foo);
echo "sech(foo) is ".$h->toString()."\n";
$h = Math_ComplexOp::csch($foo);
echo "csch(foo) is ".$h->toString()."\n";
$h = Math_ComplexOp::coth($foo);
echo "coth(foo) is ".$h->toString()."\n";
echo "====\n";
$v = Math_ComplexOp::mult($c,$c);
echo "test c*c: ".$v->toString()."\n";
$t=Math_ComplexOp::sqrt($a);
echo "sqrt(a): ".$t->toString()."\n";
$t=Math_ComplexOp::sqrt($b);
$v = Math_ComplexOp::mult($t,$t);
echo "sqrt(b): ".$t->toString()."\n";
echo "test sqrt(b)*sqrt(b): ".$v->toString()."\n";
$t=Math_ComplexOp::mult($a,$b);
echo "a*b: ".$t->toString()."\n";
$t=Math_ComplexOp::div($a,$b);
echo "a/b: ".$t->toString()."\n";
$t=Math_ComplexOp::add($a,$b);
echo "a+b: ".$t->toString()."\n";
$t=Math_ComplexOp::sub($a,$b);
echo "a-b: ".$t->toString()."\n";
$t=Math_ComplexOp::sub($b,$a);
echo "b-a: ".$t->toString()."\n";
$t=Math_ComplexOp::sub($b,Math_ComplexOp::conjugate($a));
echo "b-a': ".$t->toString()."\n";
$v=Math_ComplexOp::conjugate($b);
$t=Math_ComplexOp::sub($v,$a);
echo "b'-a: ".$t->toString()."\n";
$v=Math_ComplexOp::conjugate($b);
$t=Math_ComplexOp::sub($v,Math_ComplexOp::conjugate($a));
echo "b'-a': ".$t->toString()."\n";

?>
