<?php
/**
 * Created by PhpStorm.
 * User: Yura
 * Date: 27.11.2017
 * Time: 21:11
 */
require_once('McComplexProductList.php');
require_once('LinkedComplexProduct.php');
require_once('ComplexProduct.php');
require_once('Product.php');
require_once('McOrder.php');
require_once('products/Burger.php');
require_once('products/Coffee.php');
require_once('products/Cola.php');
require_once('products/FreeCoffee.php');
require_once('products/IceCream.php');
require_once('products/Potato.php');
require_once('products/Sauce.php');

function shopFunc()
{
    echo "please choose options and input option number\n";
    echo "1 - add product in order\n";
    echo "2 - delete product out order\n";
    echo "3 - get order with cost\n";
    echo "exit - exit\n";

}

$case = array(new Burger(), new Coffee(), new Cola(), new IceCream(), new Potato(), new Sauce());
$mcOrder = new McOrder(new McComplexProductList());
echo "input something to start";
while (($exit = fgets(STDIN)) != "exit" . PHP_EOL) {
    shopFunc();
    switch ($exit) {
        case 1 . PHP_EOL :
            echo "choose product\n";
            foreach ($case as $key => $value) {
                echo $key + 1 . " - " . $case[$key]->getName() . "(" . $case[$key]->getCost() . ")\n";
            }
            echo count($case) + 1 . "- back\n";
            while (($num = fgets(STDIN)) != count($case) + 1 . PHP_EOL) {
                unset($added);
                if (intval($num) > 0 && intval($num) < count($case) + 1 ){
                    $added = intval($num) - 1;
                }
                if (isset($added)) {
                    if ($added != count($case) + 1) {
                        $mcOrder->addProduct(new ComplexProduct($case[$added]));
                        echo $case[$added]->getName() . " added in order\n";
                        continue;
                    }
                } else {
                    echo "not added in order\n";
                    echo "please input correct product number\n";
                }
                unset($num);
                echo "7 enter to back\n";
            }
            break;
        case 2 .PHP_EOL :
            echo "choose product\n";
            $products = iterator_to_array($mcOrder->getIterator());
            foreach ($products as $key => $value) {
                echo $key + 1 . " - " . $products[$key]->getName() . "("
                    . $products[$key]->getFullCost() . ") --  " . $products[$key]->getQuantity() ."\n";
            }
            echo count($products) + 1 . " - back\n";
            while (($num = fgets(STDIN)) != count($products) + 1 . PHP_EOL) {
                unset($delete);
                if (intval($num) > 0 && intval($num) < count($products) + 1){
                    $delete = intval($num) - 1;
                }
                if (isset($delete)) {
                    if ($delete != count($products) + 1) {
                        $mcOrder->remove($delete);
                        echo " remove from order\n";
                        continue;
                    }
                } else {
                    echo "not removed from order\n";
                    echo "please input correct product number\n";
                }
                unset($num);
                echo count($products) . "enter to back\n";
            }
            break;
        case 3 . PHP_EOL:
            $products = $mcOrder->getSortedProductListByProductCost();
            foreach ($products as $key => $value) {
                echo $key + 1 . " - " . $products[$key]->getName() . "("
                    . $products[$key]->getFullCost() . ") --  " . $products[$key]->getQuantity() ."\n";
            }
            echo "Sum: " . $mcOrder ->getOrderCost() . "\n";
            break;
    }
    unset($exit);

}





