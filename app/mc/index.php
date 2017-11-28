<?php
/**
 * Created by PhpStorm.
 * User: Yura
 * Date: 27.11.2017
 * Time: 21:11
 */
require_once ('McComplexProductList.php');
$mccpl = new McComplexProductList();
$lcp = new LinkedComplexProduct(new ComplexProduct(new Product("burger", 100.0)));
$mccpl->add($lcp);
$lcp = new LinkedComplexProduct(new ComplexProduct(new Product("burger2", 101.0)));
$mccpl->add($lcp);
require_once('products/Cola.php');
$cola = new Cola();
var_dump($cola);
echo "<pre>";
var_dump($mccpl);
