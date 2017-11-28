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
require_once('../app/mc/products/FreeCoffee.php');

class ProductTest extends TestCase
{

    public function provideNames(){
        return array(
            array(new Product("Hot", 0), "Hot"),
            array(new Product("small", 2.4), "small" ),
            array(new Cola("testcola", 23), "Cola"),
            array(new Coffee("cof", 4,8), "Coffee"),
            array(new FreeCoffee("frecof", 2.0), "FreeCoffee")
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
            array(new Product("Hot", 0), 0.0),
            array(new Product("small", 2.4), 2.4 ),
            array(new Cola(), 59.0),
            array(new Coffee(), 29.0),
            array(new FreeCoffee(), 0.0)
        );
    }
    /**
     * @dataProvider provideNames
     */
    public function testCost(Product $input, $expected)
    {
        $this->assertSame($expected, $input->getCost());
    }

}