<?php
require_once('CCManager.php');

class CCenter 
{
	private $managers = null;
	public function __construct()
	{
		$this->managers = array();
	}
	public function addManager(CCManager $manager): void
	{
		$this->managers[] = $manager;
        return;
	}
	public function managersIsGreatestThan(int $score): array
	{
		$output = array();
		foreach($this->managers as $value) {
			if ($value->weakIsGreatestThan($score)) {
				$output[] = $value;
			}
		}
		return $output;
	}
}
