<?php

/**
 * Created by PhpStorm.
 * User: Yura
 * Date: 28.11.2017
 * Time: 12:50
 */
require_once ('../Product.php');
class Coffee extends Product
{
    public function __construct()
    {

        parent::__construct('Coffee', 29.0);
    }
}