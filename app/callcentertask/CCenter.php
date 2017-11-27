<?php
require_once('Manager.php');

class CCenter 
{
	private $managers = null;
	public function __construct()
	{
		$this->managers = array();
	}
	public function addManager(Manager $manager)
	{
		array_push($this->managers, $manager);
	}
	public function managersIsGreatest3()
	{
		$output = array();
		foreach($this->managers as $value) {
			if ($value->weakIsGreatest3()) {
				array_push($output, $value);
			}
		}
		return $output;
	}
}
