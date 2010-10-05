<?php

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Math_Complex_AllTests::main');
}

require_once 'PHPUnit/TextUI/TestRunner.php';

require_once 'Math_ComplexTest.php';
require_once 'Math_ComplexOpTest.php';

class Math_Complex_AllTests
{
    public static function main()
    {
        PHPUnit_TextUI_TestRunner::run(self::suite());
    }

    public static function suite()
    {
        $suite = new PHPUnit_Framework_TestSuite('PEAR - Math_Complex');

        $suite->addTestSuite('Math_ComplexTest');
        $suite->addTestSuite('Math_ComplexOpTest');

        return $suite;
    }
}

if (PHPUnit_MAIN_METHOD == 'Math_Complex_AllTests::main') {
    Math_Complex_AllTests::main();
}