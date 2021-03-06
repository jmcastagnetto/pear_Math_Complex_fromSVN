<?php
//
// +---------------------------------------------------------------------------------+
// | PHP Version 4                                                                   |
// +---------------------------------------------------------------------------------+
// | Copyright (c) 1997-2011 The PEAR Group                                          |
// | All rights reserved.                                                            |
// +---------------------------------------------------------------------------------+
// | Redistribution and use in source and binary forms, with or without              |
// | modification, are permitted provided that the following conditions are met:     |
// |     * Redistributions of source code must retain the above copyright            |
// |       notice, this list of conditions and the following disclaimer.             |
// |     * Redistributions in binary form must reproduce the above copyright         |
// |       notice, this list of conditions and the following disclaimer in the       |
// |       documentation and/or other materials provided with the distribution.      |
// |     * Neither the name of the PEAR GROUP nor the                                |
// |       names of its contributors may be used to endorse or promote products      |
// |       derived from this software without specific prior written permission.     |
// |                                                                                 |
// | THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND |
// | ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED   |
// | WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE          |
// | DISCLAIMED. IN NO EVENT SHALL THE PEAR GROUP BE LIABLE FOR ANY                  |
// | DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES      |
// | (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;    |
// | LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND     |
// | ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT      |
// | (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS   |
// | SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.                    |
// +---------------------------------------------------------------------------------+
// | Authors: Jesus M. Castagnetto <jmcastagnetto@php.net>                           |
// +---------------------------------------------------------------------------------+
//
// $Id$
//

include_once "PEAR.php";

/**
 * Package with classes to represent and manipulate complex number. Contain
 * definitions for basic arithmetic functions, as well as trigonometric,
 * inverse trigonometric, hyperbolic, inverse hyperbolic, exponential and
 * logarithms of complex numbers.
 * @package Math_Complex
 */

/**
 * Math_Complex: class to represent an manipulate complex numbers (z = a + b*i)
 *
 * Originally this class was part of NumPHP (Numeric PHP package)
 *
 * @author  Jesus M. Castagnetto <jmcastagnetto@php.net>
 * @version 0.8
 * @access  public
 */
class Math_Complex {/*{{{*/

    /**
     * The real part of the complex number
     *
     * @var float
     * @access  private
     */
    var $_real;

    /**
     * The imaginary part of the complex number
     *
     * @var float
     * @access  private
     */
    var $_im;
    
    /*{{{ Math_Complex() */
    /**
     * Constructor for Math_Complex
     * 
     * @param float $real Real part of the number
     * @param float $im Imaginary part of the number
     * @return object Math_Complex
     * @access public
     */
    function Math_Complex($real, $im) 
    {
        $this->_real = floatval($real);
        $this->_im = floatval($im);
    }/*}}}*/
    
    /**
     * Simple string representation of the number
     *
     * @return string
     * @access public
     */
    function toString() 
    {
        $r = $this->getReal();
        $i = $this->getIm();
        $str = $r;
        $str .=  ($i < 0) ? ' - ' : ' + ';
        $str .= abs($i).'i';
        return $str;
    }/*}}}*/

    /*{{{ abs2() */
    /**
     * Returns the square of the magnitude of the number
     *
     * @return float
     * @access public
     */
    function abs2() 
    {
        return ($this->_real * $this->_real + $this->_im * $this->_im);
    }/*}}}*/

    /*{{{ abs() */
    /**
     * Returns the magnitude (also referred as norm) of the number
     *
     * @return float
     * @access public
     */
    function abs() 
    {
        return sqrt($this->abs2());
    }/*}}}*/
    
    /*{{{ norm() */
    /**
     * Returns the norm of the number
     * Alias of Math_Complex::abs()
     *
     * @return float
     * @access public
     */
    function norm() 
    {
        return $this->abs();
    }/*}}}*/

    /*{{{ arg() */
    /**
     * Returns the argument of the complex number
     *
     * @return float|PEAR_Error A floating point number on success, a PEAR_Error otherwise
     * @access public
     */
    function arg() 
    {
        $arg = atan2($this->_im,$this->_real);
        if (M_PI < $arg || $arg < -1*M_PI) {
            return PEAR::raiseError('Argument has an impossible value');
        } else {
            return $arg;
        }

    }/*}}}*/

    /*{{{ angle() */
    /**
     * Returns the angle (argument) associated with the complex number
     * Alias of Math_Complex::arg()
     *
     * @return mixed A float on success, a PEAR_Error otherwise
     * @access public
     */
    function angle() {
        return $this->arg();
    }/*}}}*/

    /*{{{ getReal() */
    /**
     * Returns the real part of the complex number
     *
     * @return float
     * @access public
     */
    function getReal() 
    {
        return $this->_real;
    }/*}}}*/

    /*{{{ getIm() */
    /**
     * Returns the imaginary part of the complex number
     * @return float
     * @access public
     */
    function getIm() 
    {
        return $this->_im;
    }/*}}}*/

} /* end of Math_Complex class *//*}}}*/

?>
