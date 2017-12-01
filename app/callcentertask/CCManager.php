<?php

require_once('CCDay.php');

class CCManager
{
	private $days = null;
	private $name = null;
	public function __construct(string $name)
	{
		$this->name = $name;
		$this->days = array();
	}
	public function addCCDay(CCDay $day): void
	{
		$this->days[] = $day;
        return;
	}
	public function weakIsGreatestThan(int $score): bool
	{
		foreach($this->days as $value) {
			if (!$value->dayIsGreatestThan($score)) {
			    return false;
            }
		}
		return true;
	}
	public function getName(): string
	{
		return $this->name;
	}
}