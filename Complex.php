<?php
//
// +----------------------------------------------------------------------+
// | PHP Version 4                                                        |
// +----------------------------------------------------------------------+
// | Copyright (c) 1997-2003 The PHP Group                                |
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

include_once "PEAR.php";

/**
 * Math_Complex: class to represent an manipulate complex numbers (z = a + b*i)
 *
 * Originally this class was part of NumPHP (Numeric PHP package)
 *
 * @author  Jesus M. Castagnetto <jmcastagnetto@php.net>
 * @version 0.8
 * @access  public
 * @package Math_Complex
 */

class Math_Complex {/*{{{*/

	/**
	 * The real part of the complex number
	 *
	 * @var	float
	 * @access	private
	 */
	var $real;

	/**
	 * The imaginary part of the complex number
	 *
	 * @var float
	 * @access	private
	 */
	var $im;
	
	/**
	 * Constructor for Math_Complex
	 * 
	 * @param float $real Real part of the number
	 * @param float $im Imaginary part of the number
	 * @return object Math_Complex
	 * @access public
	 */
	function Math_Complex($real, $im) {/*{{{*/
		$this->real = floatval($real);
		$this->im = floatval($im);
	}/*}}}*/
	
	/**
	 * Simple string representation of the number
	 *
	 * @return string
	 * @access public
	 */
	function toString() {/*{{{*/
		$r = $this->getReal();
		$i = $this->getIm();
		$str = $r;
		$str .=  ($i < 0) ? ' - ' : ' + ';
		$str .= abs($i).'i';
		return $str;
	}/*}}}*/

	/**
	 * Returns the square of the magnitude of the number
	 *
	 * @return float
	 * @access public
	 */
	function abs2() {/*{{{*/
		return ($this->real*$this->real + $this->im*$this->im);
	}	/*}}}*/

	/**
	 * Returns the magnitude (also referred as norm) of the number
	 *
	 * @return float
	 * @access public
	 */
	function abs() {/*{{{*/
		return sqrt($this->abs2());
	}/*}}}*/
	
	/**
	 * Returns the norm of the number
	 * Alias of Math_Complex::abs()
	 *
	 * @return float
	 * @access public
	 */
	function norm() {/*{{{*/
		return $this->abs();
	}/*}}}*/

	/**
	 * Returns the argument of the complex number
	 *
	 * @return mixed A float on success, a PEAR_Error otherwise
	 * @access public
	 */
	function arg() {/*{{{*/
		$arg = atan2($this->im,$this->real);
		if (M_PI < $arg || $arg < -1*M_PI) {
			return PEAR::raiseError('Argument has an impossible value');
		} else {
			return $arg;
		}

	}/*}}}*/

	/**
	 * Returns the angle (argument) associated with the complex number
	 * Alias of Math_Complex::arg()
	 *
	 * @return mixed A float on success, a PEAR_Error otherwise
	 * @access public
	 */
	function angle() {/*{{{*/
		return $this->arg();
	}/*}}}*/

	/**
	 * Returns the real part of the complex number
	 *
	 * @return float
	 * @access pulic
	 */
	function getReal() {/*{{{*/
		return $this->real;
	}/*}}}*/

	/**
	 * Returns the imaginary part of the complex number
	 * @return float
	 * @access public
	 */
	function getIm() {/*{{{*/
		return $this->im;
	}/*}}}*/

} /* end of Math_Complex class *//*}}}*/

?>

