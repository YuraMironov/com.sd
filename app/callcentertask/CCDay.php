<?php

class CCDay
{
	private $scores = null;

	public function __construct()
	{
		$this->scores = array();
	}
	public function addScore(int $score): void
	{
		$this->scores[] = $score;
        return;
	}
    public function getScores():array
    {
        return $this->scores;
    }
	public function dayIsGreatestThan(int $score) : bool
	{
	    if (count($this->scores) === 0) {
	        return false;
        }
		foreach($this->scores as $value) {
            if ($value < $score) {
                return false;
            }
		}
		return true;
	}
}