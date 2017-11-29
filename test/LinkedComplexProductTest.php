<?php

/**
 * Created by PhpStorm.
 * User: Yura
 * Date: 29.11.2017
 * Time: 0:00
 */
require_once("../app/mc/Product.php");
require_once("../app/mc/ComplexProduct.php");
require_once("../app/mc/LinkedComplexProduct.php");

class LinkedComplexProductTest extends PHPUnit\Framework\TestCase
{
    public function provideTestData()
    {
        $p1 = new Product("MyProduct1", 11.1);
        $cp1 = new ComplexProduct($p1);
        $p2 = new Product("MyProduct2", 22.2);
        $cp2 = new ComplexProduct($p2);
        $lcp2 = new LinkedComplexProduct($cp2);
        $lcp1 = new LinkedComplexProduct($cp1, $lcp2);
        $lcp3 = new LinkedComplexProduct(new ComplexProduct(new Product("MyProduct3", 33.3)));
        return array(
            array($lcp2, [null, $lcp3, false]),
            array($lcp1, [$lcp2, null, true])
        );
    }

    /**
     * @dataProvider provideTestData
     */
    public function testGetNextProduct(LinkedComplexProduct $product, array $expected)
    {
        $this->assertSame($expected[0], $product->getNextProduct());
    }
    /**
     * @dataProvider provideTestData
     */
    public function testSetNextProduct(LinkedComplexProduct $product, array $expected)
    {
        $product->setNextProduct($expected[1]);
        $this->assertSame($expected[1], $product->getNextProduct());
    }
    /**
     * @dataProvider provideTestData
     */
    public function testHasNext(LinkedComplexProduct $product, array $expected)
    {
        $this->assertSame($expected[2], $product->hasNext());
    }
    public function testCompareTo(){
        $first = new LinkedComplexProduct(new ComplexProduct(new Product("first", 1.1), 2));
        $second = new LinkedComplexProduct(new ComplexProduct(new Product("second", 1.1), 1));
        $this->assertEquals(-1, LinkedComplexProduct::compareTo($first, $second));
        $this->assertEquals(1, LinkedComplexProduct::compareTo($second, $first));
        $second->setQuantity(2);
        $this->assertEquals(0, LinkedComplexProduct::compareTo($first, $second));
    }
}
