<?php

/**
 * Created by PhpStorm.
 * User: Yura
 * Date: 29.11.2017
 * Time: 12:22
 */
require_once ("../app/mc/ComplexProductList.php");
require_once ("../app/mc/LinkedComplexProduct.php");
require_once ("../app/mc/ComplexProduct.php");
require_once ("../app/mc/products/Coffee.php");
require_once ("../app/mc/products/Cola.php");
require_once ("../app/mc/products/IceCream.php");
require_once ("../app/mc/products/Burger.php");

class ComplexProductListTest extends PHPUnit\Framework\TestCase
{
    protected $emptyList;
    protected $headlyList;
    protected $headForHeadly;
    protected $fullyList;
    protected $headForFully;
    protected $tailForFully;

    public function setUp()
    {
        $this->emptyList = new ComplexProductList();
        $this->headForHeadly = new LinkedComplexProduct(new ComplexProduct(new Cola()));
        $this->headForFully = new LinkedComplexProduct(new ComplexProduct(new Coffee()));
        ($this->headlyList = new ComplexProductList())->setHead($this->headForHeadly);
        ($this->fullyList =  new ComplexProductList())->setHead($this->headForFully);
        $this->tailForFully = new LinkedComplexProduct(new ComplexProduct(new IceCream()));
        //depends getHead
        $this->fullyList->getHead()->setNextProduct($this->tailForFully);
    }
    public function tearDown()
    {
        $this->emptyList = null;
        $this->headlyList = null;
        $this->fullyList = null;
        $this->headForFully = null;
        $this->headForHeadly = null;
        $this->tailForFully = null;
    }

    public function provideForGetHead()
    {
        $mcComplexProductList = new ComplexProductList();
        $head = new LinkedComplexProduct(new ComplexProduct(new Burger()));
        $mcComplexProductList->setHead($head);
        return array(
            array(new ComplexProductList(), null),
            array($mcComplexProductList, $head)
        );
    }
    /**
     * @dataProvider provideForGetHead
     */
    public function testGetHead(ComplexProductList $mcComplexProductList, ?LinkedComplexProduct $expected)
    {
        $this->assertSame($expected, $mcComplexProductList->getHead());
    }
    public function provideForSetHead()
    {
        $head = new LinkedComplexProduct(new ComplexProduct(new Burger()));
        return array(
            array(new ComplexProductList(), null),
            array(new ComplexProductList(), $head)
        );
    }
    /**
     * @dataProvider provideForSetHead
     */
    public function testSetHead(ComplexProductList $mcComplexProductList, ?LinkedComplexProduct $expected)
    {
        if ($expected != null){
            $mcComplexProductList->setHead($expected);
        }
        $this->assertSame($expected, $mcComplexProductList->getHead());
    }

    public function provideForCount()
    {
        $mcComplexProductList = new ComplexProductList();
        $head = new LinkedComplexProduct(new ComplexProduct(new Burger()));
        $mcComplexProductList->setHead($head);
        return array(
            array(new ComplexProductList(), null),
            array($mcComplexProductList, $head)
        );
    }
    /**
     * @depends testSetHead
     * @dataProvider provideForCount
     */
    public function testCount(ComplexProductList $mcComplexProductList, $expected)
    {
        $expected = $expected === null ? 0 : 1;
        $this->assertEquals($expected, $mcComplexProductList->count());
    }

    public function provideGet()
    {
        $fullList = new ComplexProductList();
        $headForHeadly = new LinkedComplexProduct(new ComplexProduct(new Cola()));
        $headForFully = new LinkedComplexProduct(new ComplexProduct(new Coffee()));
        ($headlyList = new ComplexProductList())->setHead($headForHeadly);
        ($tailyList =  new ComplexProductList())->setHead($headForFully);
        $tailForFully = new LinkedComplexProduct(new ComplexProduct(new Burger()));
        //depends getHead
        $tailyList->getHead()->setNextProduct($tailForFully);
        return array(
            array($fullList, 0, null),
            array($headlyList, 0, $headForHeadly),
            array($headlyList, 1, null),
            array($headlyList, -1, null),
            array($tailyList, 0, $headForFully),
            array($tailyList, 1, $tailForFully),
            array($tailyList, 2, null),

        );
//        $this->setUp();
//        return array(
//            array($this->fullyList, 0, null),
//            array($this->headlyList, 0, $this->headForHeadly),
//            array($this->headlyList, 1, null),
//            array($this->headlyList, -1, null),
//            array($this->fullyList, 0, $this->headForFully),
//            array($this->fullyList, 1, $this->tailForFully),
//            array($this->fullyList, 2, null),
//
//        );
    }
    /**
     * @depends testGetHead
     * @depends testCount
     * @dataProvider provideGet
     */
    public function testGet(ComplexProductList $mcComplexProductList, $id, $expected)
    {
        if ($id < 0 || $id >= $mcComplexProductList->count()) {
            $this->expectException(Exception::class);
            $mcComplexProductList->get($id);
        } else {
            $this->assertEquals($expected, $mcComplexProductList->get($id));
        }
    }


    public function provideForRemove(){
        $this->setUp();
        return array(
            array($this->emptyList, 1),
            array($this->emptyList, 0),
            array($this->headlyList, 1),
            array($this->headlyList, 0),
            array($this->fullyList, 0),
            array($this->fullyList, 0)
        );
    }
    /**
     * @param ComplexProductList $mcComplexProductList
     * @param $id
     * @depends testCount
     * @dataProvider provideForRemove
     */
    public function testRemove(ComplexProductList $mcComplexProductList, $id){
        if ($id < 0 || $id >= $mcComplexProductList->count()) {
            $this->expectException(Exception::class);
            $mcComplexProductList->remove($id);
        } else {
            $count = $mcComplexProductList->count() - 1;
            $count = $count === -1 ? 0 : $count;
            $this->assertTrue($mcComplexProductList->remove($id));
            $this->assertEquals($count, $mcComplexProductList->count());
        }
    }

    public function provideAdd() {
        $this->setUp();
        $addedLinkedProduct = new LinkedComplexProduct(new ComplexProduct(new Burger()));
        $addedProduct = new ComplexProduct(new Coffee());
        return array(
            array($this->emptyList, $addedLinkedProduct, 1),
            array($this->emptyList, $addedProduct, 2),
            array($this->headlyList, $addedLinkedProduct, 2),
            array($this->headlyList, $addedProduct, 3),
            array($this->fullyList, $addedLinkedProduct, 3),
            array($this->fullyList, $addedProduct, 3),
            array($this->fullyList, $addedProduct, 3),
            array($this->fullyList, $addedProduct, 3)
        );
    }
    /**
     * @param ComplexProductList $mcComplexProductList
     * @param LinkedComplexProduct $linkedComplexProduct
     * @param $expectedCount
     * @depends testGet
     * @depends testSetHead
     * @depends testRemove
     * @dataProvider provideAdd
     */
    public function testAdd(ComplexProductList $mcComplexProductList, ?ComplexProduct $linkedComplexProduct, $expectedCount)
    {
        $this->assertTrue($mcComplexProductList->add($linkedComplexProduct));
        $this->assertEquals($expectedCount, $mcComplexProductList->count());
    }


}
