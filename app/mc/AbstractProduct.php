<?php

/**
 * Created by PhpStorm.
 * User: Yura
 * Date: 27.11.2017
 * Time: 20:38
 */

abstract class AbstractProduct
{
    public function __construct(string $name, float $cost){}
    public function getName():string{}
    public function setName(string $name):void{}
    public function getCost():float{}
    public function setCost(float $cost):void{}
}