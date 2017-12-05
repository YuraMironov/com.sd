<?php

/**
 * Created by PhpStorm.
 * User: Yura
 * Date: 28.11.2017
 * Time: 12:50
 */

class Gift extends Product
{

    public function __construct(string $name)
    {
        parent::__construct($name, 0);
    }
}