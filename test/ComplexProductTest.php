<?php

/**
 * Created by PhpStorm.
 * User: Yura
 * Date: 28.11.2017
 * Time: 23:30
 */
require_once ("../app/mc/products/Burger.php");
require_once ("../app/mc/ComplexProduct.php");

class ComplexProductTest extends PHPUnit\Framework\TestCase
{
    private $product;

    public function provideForSetQuantity()
    {
        $this->product = new Burger();
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
         $data = new ComplexProduct($product);
         $data->setQuantity($quantity);
         $this->assertSame($expected, $data->getQuantity());
     }
    public function provideForGetFullCost()
    {
        $this->product = new Burger();
        return array(
            array($this->product, 1, 49),
            array($this->product, 2, 98),
            array($this->product, 3, 147),
            array($this->product, 5, 245),
            array($this->product, 10, 490)
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
        $this->product = new Burger();
        return array(
            array($this->product, 1, 49),
            array($this->product, 2, 49),
            array($this->product, 3, 49),
            array($this->product, 5, 49),
            array($this->product, 10, 49)
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
    public function testCompareTo(){
        $first = new ComplexProduct(new Burger(), 2);
        $second = new ComplexProduct(new Burger(), 1);
        $this->assertEquals(-1, ComplexProduct::compareTo($first, $second));
        $this->assertEquals(1, ComplexProduct::compareTo($second, $first));
        $second->setQuantity(2);
        $this->assertEquals(0, ComplexProduct::compareTo($first, $second));
    }
}
