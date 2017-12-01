<?php

/**
 * Created by PhpStorm.
 * User: Yura
 * Date: 01.12.2017
 * Time: 0:33
 */
require_once ('..\app\callcentertask\CCenter.php');

class CCenterTest extends PHPUnit\Framework\TestCase
{
    protected $ccenter;
    protected $mvb = [];

    public function provideManagers() {
        $managers = (new CCManagerTest())->provideManagers();
        $ccenter = function ($m, $exb){
            $returnedCcenter = new CCenter();
            foreach ($this->mvb as $item) {
                $returnedCcenter->addManager($item);
            }
            $returnedCcenter->addManager($m);
            if ($exb) {
                $this->mvb[] = $m;
            }
            return $returnedCcenter;
        };
        return array(
            array($ccenter($managers[0][0], $managers[0][2]), $managers[0][1], $this->mvb),
            array($ccenter($managers[1][0], $managers[1][2]), $managers[1][1], $this->mvb),
            array($ccenter($managers[2][0], $managers[2][2]), $managers[2][1], $this->mvb),
            array($ccenter($managers[3][0], $managers[3][2]), $managers[3][1], $this->mvb)
        );
    }

    /**
     * @dataProvider provideManagers
     */
    public function testManagersIsGreatestThan($ccenter, $score, $expected)
    {
        self::assertEquals($expected, $ccenter->managersIsGreatestThan($score));
    }
}
