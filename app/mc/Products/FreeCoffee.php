<?php

/**
 * Created by PhpStorm.
 * User: Yura
 * Date: 28.11.2017
 * Time: 12:50
 */
require_once ('Coffee.php');

class FreeCoffee extends Coffee
{
    public function __construct()
    {
        $this->setName('FreeCoffee');
        $this->setCost(0.0);
    }
}