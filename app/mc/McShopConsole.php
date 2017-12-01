<?php

/**
 * Created by PhpStorm.
 * User: Yura
 * Date: 01.12.2017
 * Time: 12:46
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

class McShopConsole
{
    private $order;
    private $case;
    public function __construct(array $case)
    {
        $this->order = new McOrder(new McComplexProductList());
        foreach ($case as $product) {
            if ($product instanceof $product) {
                $this->case[] = $product;
            }
        }
    }
    public function showShopOptions():void
    {
        fwrite(STDOUT, "please choose options and input option number\n" .
            "1 - add product in order\n" .
            "2 - delete product out order\n" .
            "3 - get order with cost\n" .
            "exit - exit\n");
        return;
    }
    public function showProducts(array $case, bool $quantity = false):void{
        fwrite(STDOUT, "choose product\n");
        foreach ($case as $key => $value) {
            $str = $quantity == true ? " --  " . $case[$key]->getQuantity() . "\n" : "\n";
            fwrite(STDOUT, $key + 1 . " - " . $case[$key]->getName() . "(" . $case[$key]->getCost() . ") " . $str);
        }
        fwrite(STDOUT, count($case) + 1 . "- back\n");
        return;
    }
    public function addProduct():void{
        $this->showProducts($this->case);
        fwrite(STDOUT, "may set quantity via space (default: 1)\n" );
        while (($num = fgets(STDIN)) != count($this->case) + 1 . PHP_EOL) {
            unset($added);
            if (intval($num) > 0 && intval($num) < count($this->case) + 1) {
                $added = intval($num) - 1;
                $num = $num . ' 1';
                $quantity = intval(explode(' ', $num)[1]);
                $quantity = $quantity <= 0 ? 1 : $quantity;
            }
            if (isset($added)) {
                if ($added != count($this->case) + 1) {
                    $this->order->addProduct(new ComplexProduct($this->case[$added], $quantity));
                    $this->showProducts($this->case);
                    fwrite(STDOUT, $this->case[$added]->getName() . " added in order\n");
                    continue;
                }
            }
            fwrite(STDOUT, "not added in order\n" .
                "please input correct product number\n");
            unset($num);
            $this->showProducts($this->case);
            fwrite(STDOUT, "may set quantity via space (default - 1)\n" );
        }
        return;
    }
    public function deleteProduct():void{
        $products = iterator_to_array($this->order->getIterator());
        $this->showProducts($products, true);
        while (($num = fgets(STDIN)) != count($products) + 1 . PHP_EOL) {
            unset($delete);
            if (intval($num) > 0 && intval($num) < count($products) + 1) {
                $delete = intval($num) - 1;
            }
            if (isset($delete)) {
                if ($delete != count($products) + 1) {
                    $this->order->remove($delete);
                    $products = iterator_to_array($this->order->getIterator());
                    fwrite(STDOUT, "Product remove from order\n" .
                        "Please enter to continue\n");
                    continue;
                }
            }
            fwrite(STDOUT, "not removed from order\n" .
                "please input correct product number\n".
                "Please enter to continue\n");
            unset($num);
            $this->showProducts($products, true);
        }
        return;
    }
    public function showOrder():void
    {
        $products = $this->order->getSortedProductListByProductCost();
        foreach ($products as $key => $value) {
            echo $key + 1 . " - " . $products[$key]->getName() . "("
                . $products[$key]->getFullCost() . ") --  " . $products[$key]->getQuantity() . "\n";
        }
        fwrite(STDOUT, "Sum: " . $this->order->getOrderCost() . "\n");
        return;
    }
    public function start() : void{
        fwrite(STDOUT, "input something to start\n");
        while (($exit = fgets(STDIN)) != "exit" . PHP_EOL) {
            $this->showShopOptions();
            switch ($exit) {
                case 1 . PHP_EOL :
                    $this->addProduct();
                    break;
                case 2 . PHP_EOL :
                    $this->deleteProduct();
                    break;
                case 3 . PHP_EOL:
                    $this->showOrder();
                    break;
            }
            fwrite(STDOUT, "press enter to continue\n");
            unset($exit);
        }
        return;
    }
}