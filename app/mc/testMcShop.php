<?php
/**
 * Created by PhpStorm.
 * User: Yura
 * Date: 01.12.2017
 * Time: 13:20
 */
require_once ('McShopConsole.php');
require_once('products/Burger.php');
require_once('products/Coffee.php');
require_once('products/Cola.php');
require_once('products/IceCream.php');
require_once('products/Potato.php');
require_once('products/Sauce.php');

(new McShopConsole([new Burger(), new Coffee(), new Cola(), new IceCream(), new Potato(), new Sauce()]))->start();