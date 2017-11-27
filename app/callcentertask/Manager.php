<?php

require_once('CCDay.php');

class Manager
{
	private $days = null;
	private $name = null;
	public function __construct($name)
	{
		$this->name = $name;
		$this->days = array();
	}
	public function addCCDay(CCDay $day)
	{
		array_push($this->days, $day);
	}
	public function weakIsGreatest3()
	{
		$flag = true;
		foreach($this->days as $value) {
			$flag = $flag && $value->dayIsGreatest3();
		}
		return $flag;
	}
	public function getName()
	{
		return $this->name;
	}
}