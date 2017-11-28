<?php
/**
 * Created by PhpStorm.
 * User: Yura
 * Date: 27.11.2017
 * Time: 21:11
 */
require_once ('McComplexProductList.php');
$mccpl = new McComplexProductList();
$lcp = new LinkedComplexProduct("burger", 100.0);
//$mccpl->setHead($lcp);
//$mccpl->add($lcp);
$lcp = new LinkedComplexProduct("hotPotaito", 100.0);
try {
    $mccpl->add($lcp);
} catch (Exception $e) {
    $e->getMessage();
}
echo "<pre>";
var_dump($mccpl);
