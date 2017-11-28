<?php

/**
 * Created by PhpStorm.
 * User: Yura
 * Date: 28.11.2017
 * Time: 23:30
 */
require_once ("../app/mc/Product.php");
require_once ("../app/mc/ComplexProduct.php");

class ComplexProductTest extends PHPUnit\Framework\TestCase
{
    private $product;

    public function provideForSetQuantity()
    {
        $this->product = new Product("NewProduct", 1.1);
        return array(
            array($this->product, 1, 1),
            array($this->product, 2, 2),
            array($this->product, 3, 3),
            array($this->product, 5, 5),
            array($this->product, 10, 10)
        );
    }
    /**
     * @dataProvider provideForSetQuantity
     */
     public function testSetQuantity(Product $product, int $quantity, $expected)
     {
         $data = new ComplexProduct($product, $quantity);
         $this->assertSame($expected, $data->getQuantity());
     }
    public function provideForGetFullCost()
    {
        $this->product = new Product("NewProduct", 1.1);
        return array(
            array($this->product, 1, 1.1),
            array($this->product, 2, 2.2),
            array($this->product, 3, 3.3),
            array($this->product, 5, 5.5),
            array($this->product, 10, 11.0)
        );
    }
    /**
     * @param Product $product
     * @param int $quantity
     * @param $expected
     * @dataProvider provideForGetFullCost
     */
    public function testGetFullCost(Product $product, int $quantity, $expected)
    {
        $data = new ComplexProduct($product, $quantity);
        $this->assertSame($expected, $data->getFullCost());
    }
    public function provideForGetCost()
    {
        $this->product = new Product("NewProduct", 1.1);
        return array(
            array($this->product, 1, 1.1),
            array($this->product, 2, 1.1),
            array($this->product, 3, 1.1),
            array($this->product, 5, 1.1),
            array($this->product, 10, 1.1)
        );
    }
    /**
     * @param Product $product
     * @param int $quantity
     * @param $expected
     * @dataProvider provideForGetCost
     */
    public function testGetCost(Product $product, int $quantity, $expected)
    {
        $data = new ComplexProduct($product, $quantity);
        $this->assertSame($expected, $data->getCost());
    }
}
