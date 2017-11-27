<?php

class CCDay
{
	private $prices = null;
	public function __construct()
	{
		$this->prices = array();
	}
	public function addPrice($price)
	{
		array_push($this->prices, $price);
	}
	public function dayIsGreatest3()
	{
		$flag = true;
		foreach($this->prices as $value) {
			$flag = $flag && $value >= 3;
		}
		return $flag;
	}
}