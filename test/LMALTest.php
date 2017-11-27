<?php

/**
 * Created by PhpStorm.
 * User: Yura
 * Date: 26.11.2017
 * Time: 18:38
 */
require_once ('../app/lmal/LMAL.php');
use PHPUnit\Framework\TestCase;
class LMALTest extends TestCase
{
    public function provideLocalMax()
    {
        return array(
            array(array(1,2,3,4,5,6,4,7,1), array(6,7)),
            array(array(1,2,3,4,5,6,7,7,9), array()),
            array(array(1,2), false)
        );
    }

    /**
     * @dataProvider provideLocalMax
     */
    public function testLocalMax($input, $expected)
	{
        $result = LMAL::getLocalMax($input);
        $this->assertSame($expected, $result);
        unset($result);
	}
	public function provideMaxLength()
    {
        return array(
            array(array(1,2,3,4,5,6,7), 0),
            array(array(9,7,6,9,5,4,3,2,1), 6)
        );
    }

    /**
     * @dataProvider provideMaxLength
     */
	public function testMaxLength($input, $expected)
	{
	    $result = LMAL::getMaxLength($input);
        $this->assertSame($expected, $result);
        unset($result);
	}

}
