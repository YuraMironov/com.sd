<?php
/**
 * Created by PhpStorm.
 * User: Yura
 * Date: 27.11.2017
 * Time: 21:11
 */
require_once ('McComplexProductList.php');
require_once ('LinkedComplexProduct.php');
require_once ('ComplexProduct.php');
require_once ('Product.php');
require_once ('McOrder.php');

echo "<pre>";
$headForFully = new LinkedComplexProduct(new ComplexProduct(new Product("head", 3.3), 3));
($fullyList =  new McComplexProductList())->setHead($headForFully);
$tailForFully = new LinkedComplexProduct(new ComplexProduct(new Product("tail", 1.1), 5));
//depends getHead
$fullyList->getHead()->setNextProduct($tailForFully);
$a = new ComplexProduct(new Product("new", 23.0), 7);

$fullyList->add($a);

$mcOrder = new McOrder($fullyList);
var_dump($mcOrder->getSortedProductListByProductCost());




