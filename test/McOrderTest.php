<?php

/**
 * Created by PhpStorm.
 * User: Yura
 * Date: 30.11.2017
 * Time: 0:13
 */
require_once ("../app/mc/McOrder.php");
require_once ("../app/mc/LinkedComplexProduct.php");
require_once ("../app/mc/ComplexProduct.php");
require_once ("../app/mc/Product.php");

class McOrderTest extends PHPUnit\Framework\TestCase
{
    protected $order;
    protected $orderProductList;
    protected $products;
    protected $sortedProducts;

    public function setUp()
    {
        $headCP = new ComplexProduct(new Product("head", 3.3), 3);
        $head = new LinkedComplexProduct($headCP);
        ($fullyList = new McComplexProductList())->setHead($head);
        $tailCP = new ComplexProduct(new Product("tail", 1.1), 5);
        $tail = new LinkedComplexProduct($tailCP);
        $fullyList->getHead()->setNextProduct($tail);
        $newTail = new ComplexProduct(new Product("new", 23.0), 7);
        $fullyList->add($newTail);
        $this->orderProductList = $fullyList;
        $this->order = new McOrder($fullyList);
        $this->products = array($headCP, $tailCP, $newTail);
        $this->sortedProducts = array($newTail, $tailCP, $headCP);
    }

    public function tearDown()
    {
        $this->sortedProducts = null;
        $this->products = null;
        $this->orderProductList = null;
        $this->order = null;
    }

    /**
     *
     */
    public function testGetProductsList()
    {
        self::assertEquals($this->orderProductList, $this->order->getProductsList());
    }

    /**
     * @depends testGetProductsList
     */
    public function testSetProductsList()
    {
        $list = new McComplexProductList();
        $this->order->setProductsList($list);
        self::assertEquals($list, $this->order->getProductsList());
    }
    /**
     * @depends testGetProductsList
     */
    public function testSumOrderCost()
    {
        self::assertEquals(176.4, $this->order->sumOrderCost());
    }
    /**
     * @depends testSumOrderCost
     */
    public function testGetOrderCost()
    {
        self::assertEquals(176.4, $this->order->getOrderCost());
    }
    /**
     * @depends testGetOrderCost
     */
    public function testSetOrderCost()
    {
        $this->order->setOrderCost(101.1);
        //так как суммма заказа зависит только от его состава, то итог останется  = 176.4
        self::assertEquals(176.4, $this->order->getOrderCost());
    }
    public function testGetIterator()
    {
        self::assertEquals($this->products, iterator_to_array($this->order->getIterator()));
    }
    /**
     * @depends testGetIterator
     */
    public function testSort()
    {
        self::assertEquals($this->sortedProducts, $this->order->getSortedProductListByProductCost());
    }
}
