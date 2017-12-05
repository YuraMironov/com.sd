<?php

/**
 * Created by PhpStorm.
 * User: Yura
 * Date: 30.11.2017
 * Time: 0:13
 */
require_once("../app/mc/Order.php");
require_once ("../app/mc/LinkedComplexProduct.php");
require_once ("../app/mc/ComplexProduct.php");
require_once ("../app/mc/Product.php");
require_once("../app/mc/products/Cola.php");
require_once("../app/mc/products/Coffee.php");
require_once("../app/mc/products/Burger.php");

class OrderTest extends PHPUnit\Framework\TestCase
{
    protected $order;
    protected $orderProductList;
    protected $products;
    protected $sortedProducts;

    public function setUp()
    {
        $headCP = new ComplexProduct(new Coffee(), 3);
        $head = new LinkedComplexProduct($headCP);
        ($fullyList = new ComplexProductList())->setHead($head);
        $tailCP = new ComplexProduct(new Cola(), 5);
        $tail = new LinkedComplexProduct($tailCP);
        $fullyList->getHead()->setNextProduct($tail);
        $newTail = new ComplexProduct(new Burger(), 7);
        $fullyList->add($newTail);
        $this->orderProductList = $fullyList;
        $this->order = new Order($fullyList);
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
        $list = new ComplexProductList();
        $this->order->setProductsList($list);
        self::assertEquals($list, $this->order->getProductsList());
    }
    /**
     * @depends testGetProductsList
     */
    public function testSumOrderCost()
    {
        self::assertEquals(725, $this->order->sumOrderCost());
    }
    /**
     * @depends testSumOrderCost
     */
    public function testGetOrderCost()
    {
        self::assertEquals(725, $this->order->getOrderCost());
    }
    /**
     * @depends testGetOrderCost
     */
    public function testSetOrderCost()
    {
        $this->order->setOrderCost(101);
        //так как суммма заказа зависит только от его состава, то итог останется  = 176.4
        self::assertEquals(725, $this->order->getOrderCost());
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
