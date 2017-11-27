<?php

/**
 * Created by PhpStorm.
 * User: Yura
 * Date: 27.11.2017
 * Time: 20:38
 */

abstract class Product
{
    public function __construct(string $name, double $cost){}
    public function getName(){}
    public function setName(string $name){}
    public function getCost(){}
    public function setCost(double $cost){}
}