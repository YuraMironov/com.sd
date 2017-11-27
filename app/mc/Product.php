<?php

/**
 * Created by PhpStorm.
 * User: Yura
 * Date: 27.11.2017
 * Time: 21:13
 */
class Product extends AbstractProduct
{
    private $name;
    private $cost;

    public function __construct(string $name, double $cost)
    {
        $this->setName($name);
    }

    public function getName():string
    {
        return $this->name;
    }

    public function setName(string $name):void
    {
        $this->name = $name;
        return;
    }

    public function getCost():double
    {
        return $this->getCost();
    }

    public function setCost(double $cost):void
    {
       $this->cost = $cost;
        return;
    }
}