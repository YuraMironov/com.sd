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
    fwrite(STDOUT, "please choose options and input option number\n" .
        "1 - add product in order\n" .
        "2 - delete product out order\n" .
        "3 - get order with cost\n" .
        "exit - exit\n");

}

function chooseProduct(array $case, bool $quantity = false)
{
    fwrite(STDOUT, "choose product\n");
    foreach ($case as $key => $value) {
        $str = $quantity == true ? " --  " . $case[$key]->getQuantity() . "\n" : "\n";
        fwrite(STDOUT, $key + 1 . " - " . $case[$key]->getName() . "(" . $case[$key]->getCost() . ") " . $str);
    }
    fwrite(STDOUT, count($case) + 1 . "- back\n");
}

$case = array(new Burger(), new Coffee(), new Cola(), new IceCream(), new Potato(), new Sauce());
$mcOrder = new McOrder(new McComplexProductList());
fwrite(STDOUT, "input something to start\n");
while (($exit = fgets(STDIN)) != "exit" . PHP_EOL) {
    shopFunc();
    switch ($exit) {
        case 1 . PHP_EOL :
            chooseProduct($case);
            fwrite(STDOUT, "may set quantity via space (default - 1)" );
            while (($num = fgets(STDIN)) != count($case) + 1 . PHP_EOL) {
                unset($added);
                if (intval($num) > 0 && intval($num) < count($case) + 1) {
                    $added = intval($num) - 1;
                    $quantity = explode($num, ' ')[1];
                }
                if (isset($added)) {
                    if ($added != count($case) + 1) {
                        $mcOrder->addProduct(new ComplexProduct($case[$added]));
                        chooseProduct($case);
                        fwrite(STDOUT, $case[$added]->getName() . " added in order\n");
                        continue;
                    }
                }
                fwrite(STDOUT, "not added in order\n" .
                    "please input correct product number\n");
                unset($num);
                chooseProduct($case);
                fwrite(STDOUT, "may set quantity via space (default - 1)" );
            }
            break;
        case 2 . PHP_EOL :
            $products = iterator_to_array($mcOrder->getIterator());
            chooseProduct($products, true);
            while (($num = fgets(STDIN)) != count($products) + 1 . PHP_EOL) {
                unset($delete);
                if (intval($num) > 0 && intval($num) < count($products) + 1) {
                    $delete = intval($num) - 1;
                }
                if (isset($delete)) {
                    if ($delete != count($products) + 1) {
                        $mcOrder->remove($delete);
                        $products = iterator_to_array($mcOrder->getIterator());
                        fwrite(STDOUT, "Product remove from order\n" .
                                "Please enter to continue\n");
                        continue;
                    }
                }
                fwrite(STDOUT, "not removed from order\n" .
                    "please input correct product number\n".
                    "Please enter to continue\n");
                unset($num);
                chooseProduct($products, true);
            }
            break;
        case 3 . PHP_EOL:
            $products = $mcOrder->getSortedProductListByProductCost();
            foreach ($products as $key => $value) {
                echo $key + 1 . " - " . $products[$key]->getName() . "("
                    . $products[$key]->getFullCost() . ") --  " . $products[$key]->getQuantity() . "\n";
            }
            fwrite(STDOUT, "Sum: " . $mcOrder->getOrderCost() . "\n");
            break;
    }
    fwrite(STDOUT, "input something to continue\n");
    unset($exit);

}





