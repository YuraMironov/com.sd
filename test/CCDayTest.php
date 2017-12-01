<?php

/**
 * Created by PhpStorm.
 * User: Yura
 * Date: 30.11.2017
 * Time: 23:03
 */
require_once('../app/callcentertask/CCDay.php');

class CCDayTest extends PHPUnit\Framework\TestCase
{
    public $day;

    public function setUp()
    {
        $this->day = new CCDay();
    }

    public function tearDown()
    {
        unset($this->day);
    }
    public function setScores($scores) {
        $this->setUp();
        foreach ($scores as $val) {
            $this->day->addScore($val);
        }
    }

    public function provideScores()
    {
        $this->setUp();
        return array(
            array(array(3, 5, 4, 4, 4, 3, 4, 5, 3), 3, true),
            array(array(3, 3, 3, 5, 4, 5, 5, 4, 3), 3, true),
            array(array(2, 3, 4, 5, 5, 3, 2, 1, 2), 3, false),
            array(array(2, 3, 4, 5, 5, 3, 2, 1, 2), 1, true)
        );
    }

    /**
     * @dataProvider provideScores
     */
    public function testAddAndGetScore($expected, $a = null, $b = null)
    {
        $this->setScores($expected);
        self::assertEquals($expected, $this->day->getScores());
    }

    /**
     * @dataProvider provideScores
     * @depends      testAddAndGetScore
     */
    public function testDayIsGreatestThan($scores, $score, $expected)
    {
        $this->setScores($scores);
        self::assertEquals($expected, $this->day->dayIsGreatestThan($score));
    }

}
