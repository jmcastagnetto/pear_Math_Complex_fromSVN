<?php
//
// +----------------------------------------------------------------------+
// | PHP Version 4                                                        |
// +----------------------------------------------------------------------+
// | Copyright (c) 1997-2002 The PHP Group                                |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the PHP license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available at through the world-wide-web at                           |
// | http://www.php.net/license/2_02.txt.                                 |
// | If you did not receive a copy of the PHP license and are unable to   |
// | obtain it through the world-wide-web, please send a note to          |
// | license@php.net so we can mail you a copy immediately.               |
// +----------------------------------------------------------------------+
// | Authors: Jesus M. Castagnetto <jmcastagnetto@php.net>                |
// +----------------------------------------------------------------------+
//
// $Id$
//

include_once 'PEAR.php';
include_once 'Math/Complex.php';
include_once 'Math/TrigOp.php';

/**
 * Math_ComplexOp: static class to operate on Math_Complex objects
 *
 * Originally this class was part of NumPHP (Numeric PHP package)
 *
 * @author  Jesus M. Castagnetto <jmcastagnetto@php.net>
 * @version 0.8
 * @access  public
 * @package Math_Complex
 */

class Math_ComplexOp {/*{{{*/

	/**
	 * Checks if a given object is an instance of PEAR::Math_Complex
	 *
	 * @return boolean
	 * @access public
	 */
	function isComplex(&$c1) {/*{{{*/
		if (function_exists('is_a')) {
			return is_a(&$c1, 'math_complex');
		} else {
			return (get_class($c1) == 'math_complex' 
			        || is_subclass_of($c1, 'math_complex'));
		}
	}/*}}}*/

	/**
	 * Converts a polar complex z = r*exp(theta*i) to z = a + b*i
	 *
	 * @param float $r
	 * @param float $theta
	 * @return object Math_Complex
	 * @access public
	 */
	function &createFromPolar ($r, $theta) {/*{{{*/
		$r = floatval($r);
		$theta = floatval($theta);
		$a = $r * cos($theta);
		$b = sin($theta);
		return new Math_Complex ( $a, $b );
	}/*}}}*/

	// methods below need a valid Math_Complex object as parameter

	/**
	 * Calculates the complex square root of a complex number
	 * z = sqrt(c1)
	 *
	 * @param object Math_Complex $c1
	 * @return object Math_Complex on success, PEAR_Error otherwise
	 * @access public
	 */
	function &sqrt (&$c1) {/*{{{*/
		if (!Math_ComplexOp::isComplex($c1))
			return PEAR::raiseError('argument is not a PEAR::Math_Complex object');
		$x = abs($c1->getReal());
		$y = abs($c1->getIm());
		if ($x == 0.0  && $y == 0) {
			$r = $i = 0.0;
		} else {
			if ($x >= $y) {
				$t = $y / $x;
				$w = sqrt($x) * sqrt(0.5 * (1.0 + sqrt(1.0 + $t*$t)));
			} else {
				$t = $x / $y;
				$w = sqrt($y) * sqrt(0.5 * ($t + sqrt(1.0 + $t*$t)));
			}

			if ($c1->getReal() >= 0.0) {
				$r = $w;
				$i = $c1->getIm() / (2.0 * $w);
			} else {
				$i = ($c1->getIm() >= 0) ? $w : -1 * $w;
				$r = $c1->getIm() / (2.0 * $i);
			}
		}
		return new Math_Complex ($r, $i);
	}/*}}}*/

	/**
	 * Calculates the complex square root of a real number
	 * z = sqrt(realnumber)
	 *
	 * @param float $realnum A float
	 * @return object Math_Complex
	 * @access public
	 */
	function &sqrtReal ($realnum) {/*{{{*/
		if ($realnum >= 0) {
			$r = sqrt($realnum);
			$i = 0.0;
		} else {
			$r = 0.0;
			$i = sqrt(-1 * $realnum);
		}
		return new Math_Complex($r, $i);
	}/*}}}*/

	/**
	 * Calculates the exponential of a complex number
	 * z = exp(c1)
	 *
	 * @param object Math_Complex $c1
	 * @return object Math_Complex on success, PEAR_Error otherwise
	 * @access public
	 */
	function &exp (&$c1) {/*{{{*/
		if (!Math_ComplexOp::isComplex($c1))
			return PEAR::raiseError('argument is not a PEAR::Math_Complex object');
		$rho = exp($c1->getReal());
		$theta = $c1->getIm();

		$r = $rho * cos($theta);
		$i = $rho * sin($theta);
		return new Math_Complex($r, $i);
	}/*}}}*/

	/**
	 * Calculates the logarithm (base 2) of a complex number
	 * z = log(c1)
	 *
	 * @param object Math_Complex $c1
	 * @return object Math_Complex on success, PEAR_Error otherwise
	 * @access public
	 */
	function &log (&$c1) {/*{{{*/
		if (!Math_ComplexOp::isComplex($c1))
			return PEAR::raiseError('argument is not a PEAR::Math_Complex object');
		$r = log($c1->abs());
		$i = $c1->arg();
		return new Math_Complex($r, $i);
	}/*}}}*/

	/**
	 * Calculates the logarithm (base 10) of a complex number
	 * z = log10(c1)
	 *
	 * @param object Math_Complex $c1
	 * @return object Math_Complex on success, PEAR_Error otherwise
	 * @access public
	 */
	function &log10 (&$c1) {/*{{{*/
		$log = Math_ComplexOp::log($c1);
		if (PEAR::isError($log))
			return $log;
		return Math_ComplexOp::multReal ($log, 1/log(10));
	}/*}}}*/

	/**
	 * Calculates the conjugate of a complex number
	 * z = conj(c1)
	 *
	 * @param object Math_Complex $c1
	 * @return object Math_Complex on success, PEAR_Error otherwise
	 * @access public
	 */
	function &conjugate (&$c1) {/*{{{*/
		if (!Math_ComplexOp::isComplex($c1))
			return PEAR::raiseError('argument is not a PEAR::Math_Complex object');
		return new Math_Complex($c1->getReal(), -1 * $c1->getIm());
	}/*}}}*/

	/**
	 * Calculates the negative of a complex number
	 * z = -c1
	 *
	 * @param object Math_Complex $c1
	 * @return object Math_Complex on success, PEAR_Error otherwise
	 * @access public
	 */
	function &negative (&$c1) {/*{{{*/
		if (!Math_ComplexOp::isComplex($c1)) {
			return PEAR::raiseError('argument is not a PEAR::Math_Complex object');
		} else {
			return new Math_Complex(-1 * $c1->getReal(), -1 * $c1->getIm());
		}
	}/*}}}*/

	/**
	 * Calculates the inverse of a complex number
	 * z = 1/c1
	 *
	 * @param object Math_Complex $c1
	 * @return object Math_Complex on success, PEAR_Error otherwise
	 * @access public
	 */
	function &inverse (&$c1) {/*{{{*/
		if (!Math_ComplexOp::isComplex($c1))
			return PEAR::raiseError('argument is not a PEAR::Math_Complex object');
		$abs = $c1->abs();
		if ($abs == 0.0)
			return PEAR::raiseError('Math_Complex object\'s norm is zero');
		$temp = 1.0 / $c1->abs();
		$r = $c1->getReal() * $temp * $temp;
		$i = -1 * $c1->getIm() * $temp * $temp;
		return new Math_Complex ($r, $i);
	}/*}}}*/

	// Trigonometric methods

	/**
	 * Calculates the sine of a complex number
	 * z = sin(c1)
	 *
	 * @param object Math_Complex $c1
	 * @return object Math_Complex on success, PEAR_Error otherwise
	 * @access public
	 */
	function &sin (&$c1) {/*{{{*/
		if (!Math_ComplexOp::isComplex($c1))
			return PEAR::raiseError('argument is not a PEAR::Math_Complex object');
		$a = $c1->getReal(); $b = $c1->getIm();
		$r = sin($a)*cosh($b);
		$i = cos($a)*sinh($b);
		return new Math_Complex( $r, $i );
	}/*}}}*/

	/**
	 * Calculates the cosine of a complex number
	 * z = cos(c1)
	 *
	 * @param object Math_Complex $c1
	 * @return object Math_Complex on success, PEAR_Error otherwise
	 * @access public
	 */
	function &cos (&$c1) {/*{{{*/
		if (!Math_ComplexOp::isComplex($c1))
			return PEAR::raiseError('argument is not a PEAR::Math_Complex object');
		$a = $c1->getReal(); $b = $c1->getIm();
		$r = cos($a)*cosh($b);
		$i = sin($a)*sinh($b);
		return new Math_Complex( $r, $i );
	}/*}}}*/

	/**
	 * Calculates the tangent of a complex number
	 * z = tan(c1)
	 *
	 * @param object Math_Complex $c1
	 * @return object Math_Complex on success, PEAR_Error otherwise
	 * @access public
	 */
	function &tan (&$c1) {/*{{{*/
		if (!Math_ComplexOp::isComplex($c1))
			return PEAR::raiseError('argument is not a PEAR::Math_Complex object');
		$a = $c1->getReal(); $b = $c1->getIm();
		$den = 1 + pow(tan($a),2)*pow(tanh($b),2);
		if ($den == 0.0)
			return PEAR::raiseError('Division by zero while calculating Math_ComplexOp::tan()');
		$r = pow(Math_TrigOp::sech($b),2)*tan($a)/$den;
		$i = pow(Math_TrigOp::sec($a),2)*tanh($b)/$den;
		return new Math_Complex( $r, $i );
	}/*}}}*/

	/**
	 * Calculates the secant of a complex number
	 * z = sec(c1)
	 *
	 * @param object Math_Complex $c1
	 * @return object Math_Complex on success, PEAR_Error otherwise
	 * @access public
	 */
	function &sec (&$c1) {/*{{{*/
		if (!Math_ComplexOp::isComplex($c1))
			return PEAR::raiseError('argument is not a PEAR::Math_Complex object');
		$z = Math_ComplexOp::cos($c1);	
		return Math_ComplexOP::inverse($z);
	}/*}}}*/

	/**
	 * Calculates the cosecant of a complex number
	 * z = csc(c1)
	 *
	 * @param object Math_Complex $c1
	 * @return object Math_Complex on success, PEAR_Error otherwise
	 * @access public
	 */
	function &csc (&$c1) {/*{{{*/
		if (!Math_ComplexOp::isComplex($c1))
			return PEAR::raiseError('argument is not a PEAR::Math_Complex object');
		$z = Math_ComplexOp::sin($c1);	
		return Math_ComplexOP::inverse($z);
	}/*}}}*/

	/**
	 * Calculates the cotangent of a complex number
	 * z = cot(c1)
	 *
	 * @param object Math_Complex $c1
	 * @return object Math_Complex on success, PEAR_Error otherwise
	 * @access public
	 */
	function &cot (&$c1) {/*{{{*/
		$z = Math_ComplexOp::tan($c1);
		if (PEAR::isError($z)) {
			return $z;
		} else {
			return Math_ComplexOP::inverse($z);
		}
	}/*}}}*/

	// Inverse trigonometric methods
	
	/**
	 * Calculates the inverse sine of a complex number
	 * z = asin(c1)
	 *
	 * @param object Math_Complex $c1
	 * @return object Math_Complex on success, PEAR_Error otherwise
	 * @access public
	 */
	function &asin (&$c1) {/*{{{*/
		if (!Math_ComplexOp::isComplex($c1))
			return PEAR::raiseError('argument is not a PEAR::Math_Complex object');
		$t = Math_ComplexOp::mult($c1, $c1);
		$v = Math_ComplexOp::sub(new Math_Complex(1,0), $t);
		$t = Math_ComplexOp::sqrt($v);
		$v = new Math_Complex($t->getReal() - $c1->getIm(),
		                      $t->getIm() + $c1->getReal());
		$z = Math_ComplexOp::log($v);
		return new Math_Complex($z->getIm(), -1*$z->getReal());
	}/*}}}*/

	// alternative method
	function &asinAlt (&$c1) {/*{{{*/
		if (!Math_ComplexOp::isComplex($c1))
			return PEAR::raiseError('argument is not a PEAR::Math_Complex object');
		$r = $c1->getReal();
		$i = $c1->getIm();
		if ($i == 0) {
			return Math_ComplexOp::asinReal($r);
		} else {
			$x = abs($r); $y = abs($i);
			$r = hypot($x + 1, $y); $s = hypot($x - 1, $y);
			$a = ($r + $s)/2;
			$b = $x / $a;
			$y2 = $y * $y;
			$ac = 1.5; $bc = 0.6417; // crossover values

			if ($b <= $bc) {
				$real = asin($b);
			} else {
				if ($x <= 1) {
					$d = 0.5 * ($a + $x) * ($y2 / ($r + $x + 1) + ($s + (1 - $x)));
					$real = atan2($x, sqrt($d));
				} else {
					$ax = $a + $x;
					$d = 0.5 * ($ax / ($r + $x + 1) + $ax / ($s + ($x - 1)));
					$real = atan2($x, $y * sqrt($d));
				}
			}

			if ($a <= $ac) {
				if ($x < 1) {
					$m = 0.5 * ($y2 / ($r + ($x + 1)) + $y2 / ($s + (1 - $x)));
				} else {
					$m = 0.5 * ($y2 / ($r + ($x + 1)) + ($s + ($x - 1)));
				}
				$im = log1p($m + sqrt($m * ($a + 1)));
			} else {
				$im = log($a + sqrt($a * $a - 1));
			}
			$real = ($r >= 0) ? $real : -1*$real;
			$im = ($i >= 0) ? $im : -1*$im;
			return new Math_Complex($real, $im);
		}
	}/*}}}*/

	/**
	 * Calculates the complex inverse sine of a real number
	 * z = asinReal(r)
	 *
	 * @param float $r
	 * @return object Math_Complex 
	 * @access public
	 */
	function &asinReal($r) {/*{{{*/
		$r = floatval($r);
		if (abs($r) <= 1.0) {
			return new Math_Complex(asin($r), 0.0);
		} else {
			if ($r < 0.0) {
				return new Math_Complex(-1*M_PI_2, acosh($r));
			} else {
				return new Math_Complex(M_PI_2, -1*acosh($r));
			}
		}
	}/*}}}*/

	/**
	 * Calculates the inverse cosine of a complex number
	 * z = acos(c1)
	 *
	 * @param object Math_Complex $c1
	 * @return object Math_Complex on success, PEAR_Error otherwise
	 * @access public
	 */
	function &acos (&$c1) {/*{{{*/
		if (!Math_ComplexOp::isComplex($c1))
			return PEAR::raiseError('argument is not a PEAR::Math_Complex object');
		$t = Math_ComplexOp::mult($c1, $c1);
		$v = Math_ComplexOp::sub(new Math_Complex(1,0), $t);
		$t = Math_ComplexOp::sqrt($v);
		$v = new Math_Complex($c1->getReal() - $t->getIm(),
		                      $c1->getIm() + $t->getReal());
		$z = Math_ComplexOp::log($v);
		return new Math_Complex($z->getIm(), -1*$z->getReal());
	}/*}}}*/
	
	/**
	 * Calculates the inverse tangent of a complex number
	 * z = atan(c1)
	 *
	 * @param object Math_Complex $c1
	 * @return object Math_Complex on success, PEAR_Error otherwise
	 * @access public
	 */
	function &atan (&$c1) {/*{{{*/
		if (!Math_ComplexOp::isComplex($c1))
			return PEAR::raiseError('argument is not a PEAR::Math_Complex object');
		$u = new Math_Complex(-1*$c1->getIm(), $c1->getReal());
		$t = new Math_Complex(1,0);
		$d1 = Math_ComplexOp::sub($t, $u);
		$d2 = Math_ComplexOp::add($t, $u);
		$u = Math_ComplexOp::div($d1, $d2);
		if (PEAR::isError($u)) {
			return $u;
		} else {
			return Math_ComplexOp::multIm(Math_ComplexOp::log($u), 0.5);
		}
	}/*}}}*/

	/**
	 * Calculates the inverse secant of a complex number
	 * z = asec(c1)
	 *
	 * @param object Math_Complex $c1
	 * @return object Math_Complex on success, PEAR_Error otherwise
	 * @access public
	 */
	function &asec (&$c1) {/*{{{*/
		if (!Math_ComplexOp::isComplex($c1))
			return PEAR::raiseError('argument is not a PEAR::Math_Complex object');
		$z = Math_ComplexOp::inverse($c1); // get the cosine
		if (PEAR::isError($z)) {
			return $z;
		} else {
			return Math_ComplexOp::acos($z);
		}
	}/*}}}*/

	/**
	 * Calculates the inverse cosecant of a complex number
	 * z = acsc(c1)
	 *
	 * @param object Math_Complex $c1
	 * @return object Math_Complex on success, PEAR_Error otherwise
	 * @access public
	 */
	function &acsc (&$c1) {/*{{{*/
		if (!Math_ComplexOp::isComplex($c1))
			return PEAR::raiseError('argument is not a PEAR::Math_Complex object');
		$z = Math_ComplexOp::inverse($c1); // get the sine
		if (PEAR::isError($z)) {
			return $z;
		} else {
			return Math_ComplexOp::asin($z);
		}
	}/*}}}*/

	/**
	 * Calculates the inverse cotangent of a complex number
	 * z = acot(c1)
	 *
	 * @param object Math_Complex $c1
	 * @return object Math_Complex on success, PEAR_Error otherwise
	 * @access public
	 */
	function &acot (&$c1) {/*{{{*/
		if (!Math_ComplexOp::isComplex($c1))
			return PEAR::raiseError('argument is not a PEAR::Math_Complex object');
		$z = Math_ComplexOp::inverse($c1); // get the tangent
		if (PEAR::isError($z)) {
			return $z;
		} else {
			return Math_ComplexOp::atan($z);
		}
	}/*}}}*/

	// Hyperbolic methods
	
	/**
	 * Calculates the hyperbolic sine of a complex number
	 * z = sinh(c1)
	 *
	 * @param object Math_Complex $c1
	 * @return object Math_Complex on success, PEAR_Error otherwise
	 * @access public
	 */
	function &sinh (&$c1) {/*{{{*/
		if (!Math_ComplexOp::isComplex($c1)) {
			return PEAR::raiseError('argument is not a PEAR::Math_Complex object');
		}
		$r = $c1->getReal();
		$i = $c1->getIm();
		return new Math_Complex(sinh($r) * cos($i), cosh($r) * sin($i));
	}/*}}}*/

	/**
	 * Calculates the hyperbolic cosine of a complex number
	 * z = cosh(c1)
	 *
	 * @param object Math_Complex $c1
	 * @return object Math_Complex on success, PEAR_Error otherwise
	 * @access public
	 */
	function &cosh (&$c1) {/*{{{*/
		if (!Math_ComplexOp::isComplex($c1)) {
			return PEAR::raiseError('argument is not a PEAR::Math_Complex object');
		}
		$r = $c1->getReal();
		$i = $c1->getIm();
		return new Math_Complex(cosh($r) * cos($i), sinh($r) * sin($i));
	}/*}}}*/

	/**
	 * Calculates the hyperbolic tangent of a complex number
	 * z = tanh(c1)
	 *
	 * @param object Math_Complex $c1
	 * @return object Math_Complex on success, PEAR_Error otherwise
	 * @access public
	 */
	function &tanh (&$c1) {/*{{{*/
		if (!Math_ComplexOp::isComplex($c1)) {
			return PEAR::raiseError('argument is not a PEAR::Math_Complex object');
		}
		$r = $c1->getReal();
		$i = $c1->getIm();
		$d = cos($i) * cos($i) + sinh($r) * sinh($r);
		return new Math_Complex(sinh($r) * cosh($r) / $d, 0.5 * sin(2 * $i) / $d);
	}/*}}}*/

	/**
	 * Calculates the hyperbolic secant of a complex number
	 * z = sech(c1)
	 *
	 * @param object Math_Complex $c1
	 * @return object Math_Complex on success, PEAR_Error otherwise
	 * @access public
	 */
	function &sech (&$c1) {/*{{{*/
		$c2 = Math_ComplexOp::cosh($c1);
		if (PEAR::isError($c2)) {
			return $c2;
		} else {
			return Math_ComplexOp::inverse($c2);
		}
	}/*}}}*/

	/**
	 * Calculates the hyperbolic cosecant of a complex number
	 * z = csch(c1)
	 *
	 * @param object Math_Complex $c1
	 * @return object Math_Complex on success, PEAR_Error otherwise
	 * @access public
	 */
	function &csch (&$c1) {/*{{{*/
		$c2 = Math_ComplexOp::sinh($c1);
		if (PEAR::isError($c2)) {
			return $c2;
		} else {
			return Math_ComplexOp::inverse($c2);
		}
	}/*}}}*/

	/**
	 * Calculates the hyperbolic cotangent of a complex number
	 * z = coth(c1)
	 *
	 * @param object Math_Complex $c1
	 * @return object Math_Complex on success, PEAR_Error otherwise
	 * @access public
	 */
	function &coth (&$c1) {/*{{{*/
		$c2 = Math_ComplexOp::tanh($c1);
		if (PEAR::isError($c2)) {
			return $c2;
		} else {
			return Math_ComplexOp::inverse($c2);
		}
	}/*}}}*/

	// Inverse hyperbolic methods
	
	/**
	 * Calculates the inverse hyperbolic sine of a complex number
	 * z = asinh(c1)
	 *
	 * @param object Math_Complex $c1
	 * @return object Math_Complex on success, PEAR_Error otherwise
	 * @access public
	 */
	function &asinh (&$c1) {/*{{{*/
		if (!Math_ComplexOp::isComplex($c1)) {
			return PEAR::raiseError('argument is not a PEAR::Math_Complex object');
		}
		$z = Math_ComplexOp::multIm($c1, 1.0);
		$z = Math_ComplexOp::asin($z);
		if (PEAR::isError($z)) {
			return $z;
		} else {
			return Math_ComplexOp::multIm($z, -1.0);
		}
	}/*}}}*/

	/**
	 * Calculates the inverse hyperbolic cosine of a complex number
	 * z = acosh(c1)
	 *
	 * @param object Math_Complex $c1
	 * @return object Math_Complex on success, PEAR_Error otherwise
	 * @access public
	 */
	function &acosh (&$c1) {/*{{{*/
		if (!Math_ComplexOp::isComplex($c1)) {
			return PEAR::raiseError('argument is not a PEAR::Math_Complex object');
		}
		$z = Math_ComplexOp::acos($c1);
		if (PEAR::isError($z)) {
			return $z;
		} else {
			return Math_ComplexOp::multIm($z, (($z->getIm() > 0) ? 1.0 : -1.0));
		}
	}/*}}}*/

	/**
	 * Calculates the inverse hyperbolic tangent of a complex number
	 * z = atanh(c1)
	 *
	 * @param object Math_Complex $c1
	 * @return object Math_Complex on success, PEAR_Error otherwise
	 * @access public
	 */
	function &atanh (&$c1) {/*{{{*/
		if (!Math_ComplexOp::isComplex($c1)) {
			return PEAR::raiseError('argument is not a PEAR::Math_Complex object');
		}
		if ($c1->getIm() == 0.0) {
			$r = $c1->getReal();
			if ($r > -1.0 && $r < 1.0) {
				return Math_Complex(atanh($r), 0.0);
			} else {
				return Math_Complex(atanh(1 / $r), (($a < 0) ? M_PI_2 : -1 * M_PI_2));
			}
		} else {
			$z = Math_ComplexOp::multIm($c1, 1.0);
			$z = Math_ComplexOp::atan($z);
			return Math_ComplexOp::multIm($z, -1.0);
		}
	}/*}}}*/

	/**
	 * Calculates the inverse hyperbolic secant of a complex number
	 * z = asech(c1)
	 *
	 * @param object Math_Complex $c1
	 * @return object Math_Complex on success, PEAR_Error otherwise
	 * @access public
	 */
	function &asech (&$c1) {/*{{{*/
		if (!Math_ComplexOp::isComplex($c1)) {
			return PEAR::raiseError('argument is not a PEAR::Math_Complex object');
		}
		$z = Math_ComplexOp::inverse($c1);
		return Math_ComplexOp::acosh($z);
	}/*}}}*/

	/**
	 * Calculates the inverse hyperbolic cosecant of a complex number
	 * z = acsch(c1)
	 *
	 * @param object Math_Complex $c1
	 * @return object Math_Complex on success, PEAR_Error otherwise
	 * @access public
	 */
	function &acsch (&$c1) {/*{{{*/
		if (!Math_ComplexOp::isComplex($c1)) {
			return PEAR::raiseError('argument is not a PEAR::Math_Complex object');
		}
		$z = Math_ComplexOp::inverse($c1);
		return Math_ComplexOp::asinh($z);
	}/*}}}*/

	/**
	 * Calculates the inverse hyperbolic cotangent of a complex number
	 * z = acoth(c1)
	 *
	 * @param object Math_Complex $c1
	 * @return object Math_Complex on success, PEAR_Error otherwise
	 * @access public
	 */
	function &acoth (&$c1) {/*{{{*/
		if (!Math_ComplexOp::isComplex($c1)) {
			return PEAR::raiseError('argument is not a PEAR::Math_Complex object');
		}
		$z = Math_ComplexOp::inverse($c1);
		return Math_ComplexOp::atanh($z);
	}/*}}}*/

	// functions below need 2 valid Math_Complex objects as parameters

	/**
	 * Determines if is c1 == c2 
	 *
	 * @param object Math_Complex $c1
	 * @param object Math_Complex $c2
	 * @return mixed True if $c1 == $c2, False if $c1 != $c2, PEAR_Error object on error
	 * @access public
	 */
	function &areEqual (&$c1, &$c2) {/*{{{*/
		if (!Math_ComplexOp::isComplex($c1) 
			|| !Math_ComplexOp::isComplex($c2)) {
			return PEAR::raiseError('Both arguments must be PEAR::Math_Complex objects');
		} else {
			$same_class = ( get_class($c1) == get_class($c2) );
			$same_real = ( $c1->getReal() == $c2->getReal() );
			$same_im = ( $c1->getIm() == $c2->getIm() );
			return ( $same_class && $same_real && $same_im );
		}
	}/*}}}*/

	/**
	 * Returns the sum of two complex numbers: z = c1 + c2
	 *
	 * @param object Math_Complex $c1
	 * @param object Math_Complex $c2
	 * @return object Math_Complex on success, PEAR_Error otherwise
	 * @access public
	 */
	function &add (&$c1, &$c2) {/*{{{*/
		if (!Math_ComplexOp::isComplex($c1) 
			|| !Math_ComplexOp::isComplex($c2)) {
			return PEAR::raiseError('Both arguments must be PEAR::Math_Complex objects');
		} else {
			return new Math_Complex( $c1->getReal() + $c2->getReal(), $c1->getIm() + $c2->getIm());
		}
	}/*}}}*/

	/**
	 * Returns the difference of two complex numbers: z = c1 - c2
	 *
	 * @param object Math_Complex $c1
	 * @param object Math_Complex $c2
	 * @return object Math_Complex on success, PEAR_Error otherwise
	 * @access public
	 */
	function &sub (&$c1, &$c2) {/*{{{*/
		$nc2 = Math_ComplexOp::negative($c2);
		if (PEAR::isError($nc2)) {
			return $nc2;
		} else {
			return Math_ComplexOp::add($c1, $nc2);
		}
	}/*}}}*/

	/**
	 * Returns the product of two complex numbers: z = c1 * c2
	 *
	 * @param object Math_Complex $c1
	 * @param object Math_Complex $c2
	 * @return object Math_Complex on success, PEAR_Error otherwise
	 * @access public
	 */
	function &mult (&$c1, &$c2) {/*{{{*/
		if (!Math_ComplexOp::isComplex($c1) 
			|| !Math_ComplexOp::isComplex($c2)) {
			return PEAR::raiseError('Both arguments must be PEAR::Math_Complex objects');
		} else {
			$r = ($c1->getReal() * $c2->getReal()) - ($c1->getIm() * $c2->getIm());
			$i = ($c1->getReal() * $c2->getIm()) + ($c2->getReal() * $c1->getIm());
			return new Math_Complex( $r, $i );
		}
	}/*}}}*/

	/**
	 * Returns the division of two complex numbers: z = c1 * c2
	 *
	 * @param object Math_Complex $c1
	 * @param object Math_Complex $c2
	 * @return object Math_Complex on success, PEAR_Error otherwise
	 * @access public
	 */
	function &div (&$c1, &$c2) {/*{{{*/
		if (!Math_ComplexOp::isComplex($c1) 
			|| !Math_ComplexOp::isComplex($c2)) {
			return PEAR::raiseError('Both arguments must be PEAR::Math_Complex objects');
		} else {
			$a = $c1->getReal(); $b = $c1->getIm();
			$c = $c2->getReal(); $d = $c2->getIm();
			$div = $c*$c + $d*$d;
			if ($div == 0.0) {
				return PEAR::raiseError('Division by zero in Math_ComplexOp::div()');
			} else {
				$r = ($a*$c + $b*$d)/$div;
				$i = ($b*$c - $a*$d)/$div;
				return new Math_Complex( $r, $i );
			}
		}
	}/*}}}*/

	/**
	 * Returns the complex power of two complex numbers: z = c1^c2
	 *
	 * @param object Math_Complex $c1
	 * @param object Math_Complex $c2
	 * @return object Math_Complex on success, PEAR_Error otherwise
	 * @access public
	 */
	function &pow (&$c1, &$c2) {/*{{{*/
		if (!Math_ComplexOp::isComplex($c1) 
			|| !Math_ComplexOp::isComplex($c2)) {
			return PEAR::raiseError('Both arguments must be PEAR::Math_Complex objects');
		} else {
			$ar = $c1->getReal(); $ai = $c1->getIm();
			$br = $c2->getReal(); $bi = $c2->getIm();

			if ($ar == 0.0 && $ai == 0.0) {
				$r = $i = 0.0;
			} else {
				$logr = log($c1->abs());
				$theta = $c1->arg();
				$rho = exp($logr * $br - $bi * $theta);
				$beta = $theta * $br + $bi * $logr;
				$r = $rho * cos($beta);
				$i = $rho * sin($beta);
			}
			return new Math_Complex($r, $i);
		}
	}/*}}}*/

	/**
	 * Returns the logarithm of base c2 of the complex number c1
	 *
	 * @param object Math_Complex $c1
	 * @param object Math_Complex $c2
	 * @return object Math_Complex on success, PEAR_Error otherwise
	 * @access public
	 */
	function &logBase (&$c1, &$c2) {/*{{{*/
		if (!Math_ComplexOp::isComplex($c1) 
			|| !Math_ComplexOp::isComplex($c2)) {
			return PEAR::raiseError('Both arguments must be PEAR::Math_Complex objects');
		} else {
			return Math_ComplexOp::div(Math_ComplexOp::log($c1), Math_ComplexOp::log($c2));
		}
	}/*}}}*/

	// these functions need a complex number and a real number

	/**
	 * Multiplies a complex number by a real number
	 *
	 * z = realnumber * c1
	 *
	 * @param object Math_Complex $c1
	 * @param float $real
	 * @return object Math_Complex on success, PEAR_Error otherwise
	 * @access public
	 */
	function &multReal (&$c1, $real) {/*{{{*/
		if (!Math_ComplexOp::isComplex($c1)) {
			return PEAR::raiseError('First argument is not a PEAR::Math_Complex object');
		}
		if (!is_numeric($real)) {
			return PEAR::raiseError('Second argument is not valid real number');
		}
		$r = $c1->getReal() * $real;
		$i = $c1->getIm() * $real;
		return new Math_Complex($r, $i);
	}/*}}}*/

	/**
	 * Returns the product of a complex number and an imaginary number
	 * x = b + c*i
	 * y = a*i
	 * z = x * y = multIm(x, a);
	 *
	 * @param object Math_Complex $c1
	 * @param float $im
	 * @return object Math_Complex on success, PEAR_Error otherwise
	 * @access public
	 */
	function &multIm ($c1, $im) {/*{{{*/
		if (!Math_ComplexOp::isComplex($c1)) {
			return PEAR::raiseError('First arguments must be PEAR::Math_Complex object');
		} elseif (!is_numeric($im)) {
			return PEAR::raiseError("An imaginary coefficient is needed as second parameter");
		} else {
			$r = -1 * $c1->getIm() * $im;
			$i = $c1->getReal() * $im;
			return new Math_Complex($r, $i);
		}
	}/*}}}*/

	/**
	 * Returns the exponentiation of a complex numbers to a real power: z = c1^(real)
	 *
	 * @param object Math_Complex $c1
	 * @param float $real
	 * @return object Math_Complex on success, PEAR_Error otherwise
	 * @access public
	 */
	function &powReal ($c1, $real) {/*{{{*/
		if (!Math_ComplexOp::isComplex($c1)) {
			return PEAR::raiseError('First arguments must be PEAR::Math_Complex object');
		} elseif (!is_numeric($real)) {
			return PEAR::raiseError("An real number is needed as second parameter");
		} else {
			$ar = $c1->getReal(); $ai = $c1->getIm();
			if ($ar == 0 && $ai == 0) {
				$r = $i = 0.0;
			} else {
				$logr = log($c1->abs());
				$theta = $c1->arg();
				$rho = exp($logr * $real);
				$beta = $theta * $real;
				$r = $rho * cos($beta);
				$i = $rho * sin($beta);
			}
			return new Math_Complex($r, $i);
		}
	}/*}}}*/


}/*}}} End of Math_ComplexOp*/
?>
