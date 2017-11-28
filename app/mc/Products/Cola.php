<?php

/**
 * Created by PhpStorm.
 * User: Yura
 * Date: 28.11.2017
 * Time: 12:49
 */
require_once ('../Product.php');
class Cola extends Product
{
    public function __construct()
    {
        parent::__construct('Cola', 59.0);
    }
}