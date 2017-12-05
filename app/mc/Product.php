<?php

/**
 * Created by PhpStorm.
 * User: Yura
 * Date: 27.11.2017
 * Time: 21:13
 */

abstract class Product
{
    private $name;
    private $cost;

    public function __construct(string $name, int $cost = 0)
    {
        $this->setName($name);
        $this->setCost($cost);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
        return;
    }

    public function getCost(): int
    {
        return $this->cost;
    }

    public function setCost(float $cost): void
    {
       $this->cost = $cost;
        return;
    }
}