<?php

/**
 * Created by PhpStorm.
 * User: Yura
 * Date: 29.11.2017
 * Time: 12:22
 */
require_once ("../app/mc/McComplexProductList.php");
require_once ("../app/mc/LinkedComplexProduct.php");
require_once ("../app/mc/ComplexProduct.php");
require_once ("../app/mc/Product.php");
class McComplexProductListTest extends PHPUnit\Framework\TestCase
{
    protected $emptyList;
    protected $headlyList;
    protected $headForHeadly;
    protected $fullyList;
    protected $headForFully;
    protected $tailForFully;

    public function setUp()
    {
        $this->emptyList = new McComplexProductList();
        $this->headForHeadly = new LinkedComplexProduct(new ComplexProduct(new Product("head2", 2.2)));
        $this->headForFully = new LinkedComplexProduct(new ComplexProduct(new Product("head3", 3.3)));
        ($this->headlyList = new McComplexProductList())->setHead($this->headForHeadly);
        ($this->fullyList =  new McComplexProductList())->setHead($this->headForFully);
        $this->tailForFully = new LinkedComplexProduct(new ComplexProduct(new Product("test", 1.1)));
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
        $mcComplexProductList = new McComplexProductList();
        $head = new LinkedComplexProduct(new ComplexProduct(new Product("Head Product", 100.0)));
        $mcComplexProductList->setHead($head);
        return array(
            array(new McComplexProductList(), null),
            array($mcComplexProductList, $head)
        );
    }
    /**
     * @dataProvider provideForGetHead
     */
    public function testGetHead(McComplexProductList $mcComplexProductList, ?LinkedComplexProduct $expected)
    {
        $this->assertSame($expected, $mcComplexProductList->getHead());
    }
    public function provideForSetHead()
    {
        $head = new LinkedComplexProduct(new ComplexProduct(new Product("Head Product", 100.0)));
        return array(
            array(new McComplexProductList(), null),
            array(new McComplexProductList(), $head)
        );
    }
    /**
     * @dataProvider provideForSetHead
     */
    public function testSetHead(McComplexProductList $mcComplexProductList, ?LinkedComplexProduct $expected)
    {
        if ($expected != null){
            $mcComplexProductList->setHead($expected);
        }
        $this->assertSame($expected, $mcComplexProductList->getHead());
    }

    public function provideForCount()
    {
        $mcComplexProductList = new McComplexProductList();
        $head = new LinkedComplexProduct(new ComplexProduct(new Product("Head Product", 100.0)));
        $mcComplexProductList->setHead($head);
        return array(
            array(new McComplexProductList(), null),
            array($mcComplexProductList, $head)
        );
    }
    /**
     * @depends testSetHead
     * @dataProvider provideForCount
     */
    public function testCount(McComplexProductList $mcComplexProductList, $expected)
    {
        $expected = $expected === null ? 0 : 1;
        $this->assertEquals($expected, $mcComplexProductList->count());
    }

    public function provideGet()
    {
        $fullList = new McComplexProductList();
        $headForHeadly = new LinkedComplexProduct(new ComplexProduct(new Product("head2", 2.2)));
        $headForFully = new LinkedComplexProduct(new ComplexProduct(new Product("head3", 3.3)));
        ($headlyList = new McComplexProductList())->setHead($headForHeadly);
        ($tailyList =  new McComplexProductList())->setHead($headForFully);
        $tailForFully = new LinkedComplexProduct(new ComplexProduct(new Product("test", 1.1)));
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
    public function testGet(McComplexProductList $mcComplexProductList, $id, $expected)
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
     * @param McComplexProductList $mcComplexProductList
     * @param $id
     * @depends testCount
     * @dataProvider provideForRemove
     */
    public function testRemove(McComplexProductList $mcComplexProductList, $id){
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
        $addedLinkedProduct = new LinkedComplexProduct(new ComplexProduct(new Product("addedLinkedProduct", 12.2)));
        $addedProduct = new ComplexProduct(new Product("addedProduct", 13.2));
        return array(
            array($this->emptyList, $addedLinkedProduct, 1),
            array($this->emptyList, $addedProduct, 2),
            array($this->headlyList, $addedLinkedProduct, 2),
            array($this->headlyList, $addedProduct, 3),
            array($this->fullyList, $addedLinkedProduct, 3),
            array($this->fullyList, $addedProduct, 4),
            array($this->fullyList, $addedProduct, 4),
            array($this->fullyList, $addedProduct, 4)
        );
    }
    /**
     * @param McComplexProductList $mcComplexProductList
     * @param LinkedComplexProduct $linkedComplexProduct
     * @param $expectedCount
     * @depends testGet
     * @depends testSetHead
     * @depends testRemove
     * @dataProvider provideAdd
     */
    public function testAdd(McComplexProductList $mcComplexProductList, ?ComplexProduct $linkedComplexProduct, $expectedCount)
    {
        $this->assertTrue($mcComplexProductList->add($linkedComplexProduct));
        $this->assertEquals($expectedCount, $mcComplexProductList->count());
    }


}
