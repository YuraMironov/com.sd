<?php

/**
 * Created by PhpStorm.
 * User: Yura
 * Date: 28.11.2017
 * Time: 13:20
 */
use PHPUnit\Framework\TestCase;

require_once ('../app/mc/Product.php');
require_once('../app/mc/products/Cola.php');
require_once('../app/mc/products/Coffee.php');
require_once('../app/mc/products/Gift.php');

class ProductTest extends TestCase
{

    public function provideNames(){
        return array(
            array(new Cola("testcola", 23), "Cola"),
            array(new Coffee("cof", 4), "Coffee"),
            array(new Gift("FreeCoffee"), "FreeCoffee")
        );
    }
    /**
     * @dataProvider provideNames
     */
    public function testName(Product $input, $expected)
    {
        $this->assertSame($expected, $input->getName());
    }

    public function provideCosts(){
        return array(
            array(new Cola(), 59),
            array(new Coffee(), 29),
            array(new Gift("gift"), 0)
        );
    }
    /**
     * @dataProvider provideCosts
     */
    public function testCost(Product $input, $expected)
    {
        $this->assertSame($expected, $input->getCost());
    }

}