<?php


class MyQueue
{	
	private $maxLength = 10;
	private $length = 0;
	private $queue = null;
	private $first = null;
	private $last = null;
	public function __construct(array $args = array())
	{	
		$this->queue = array();
		if (count($args) != 0) {
			$i = 0;
			foreach ($args as $value) {
				if ($i < $this->maxLength) {
					array_push($this->queue, $value);
					$i++;
				}
			}
		}
	}
	public function getQueue()
	{
		return $this->queue;
	}
	public function getBusy()
	{
		return count($this->queue);
	}

	public function addToEnd($value) 
	{	
		if (!(is_array($value)) && $this->getBusy() < 10) {
			array_push($this->queue, $value);
			return true;
		}
		echo "queue is busy";
		return false;
	}
	public function getFirstKey()
	{
		if ($this->getBusy() > 0){
			return array_keys($this->queue)[0];
		}
		return false;
	}
	public function deleteFirst()
	{
		if ($this->getBusy() > 0){
			unset($this->queue[$this->getFirstKey()]);
			return true;
		} else {
			echo "Queue is empty! \n";
		}
		return false;
	}
	public function getFirstAndLast()
	{
		if ($this->getBusy() > 0) {
			$first = $this->queue[$this->getFirstKey()];
			$last = array_pop($this->queue);
			array_push($this->queue, $last);
			$firstAndLast = [
				'first' => $first,
				'last' =>$last
			];
			return $firstAndLast;
		}
		return false;
	}

}