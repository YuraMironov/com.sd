<?php

/**
 * Created by PhpStorm.
 * User: Yura
 * Date: 30.11.2017
 * Time: 23:35
 */
require_once('../app/callcentertask/CCManager.php');

class CCManagerTest extends PHPUnit\Framework\TestCase
{
    public function testGetName() {
        $name = "Kostya";
        self::assertEquals($name, (new CCManager($name))->getName());
    }

    public function provideManagers()
    {
        $day = new CCDayTest();
        $scores = $day->provideScores();
        $ccday = function($scores):CCDay{
            $a = new CCDay();
            foreach ($scores as $val) {
                $a->addScore($val);
            }
            return $a;
        };
        $ccm = function ($d){
            $m = new CCManager("test");
            $m->addCCDay($d);
            return $m;
        };
        return array(
            array($ccm($ccday($scores[0][0])), $scores[0][1], $scores[0][2]),
            array($ccm($ccday($scores[1][0])), $scores[1][1], $scores[1][2]),
            array($ccm($ccday($scores[2][0])), $scores[2][1], $scores[2][2]),
            array($ccm($ccday($scores[3][0])), $scores[3][1], $scores[3][2])
        );
    }

    /**
     * @dataProvider provideManagers
     */
    public function testWeakIsGreatestThat($manager, $score, $expected){
        self::assertEquals($expected, $manager->weakIsGreatestThan($score));
    }
}
