<?php


class MyQueue
{
    private $maxLength = 10;
    private $queue = null;

    public function __construct(array $args = array())
    {
        $this->queue = array();
        if (count($args) != 0) {
            foreach (array_slice($args, 0, $this->maxLength) as $value) {
                $this->addToEnd($value);
            }
        }
    }

    public function getQueue(): array
    {
        return $this->queue;
    }

    public function getBusy(): int
    {
        return count($this->queue);
    }

    public function addToEnd(array $value): bool
    {
        if ($this->getBusy() < $this->maxLength) {
            $this->queue[] = $value;
            return true;
        }
        return false;
    }

    public function getFirstKey(): ?int
    {
        if ($this->getBusy() > 0) {
            return array_keys($this->queue)[0];
        }
        return null;
    }
    public function getLastKey(): ?int
    {
        if ($this->getBusy() > 0) {
            return array_pop(array_keys($this->queue));
        }
        return null;
    }

    public function deleteFirst(): bool
    {
        if ($this->getBusy() > 0) {
            unset($this->queue[$this->getFirstKey()]);
            return true;
        }
        return false;
    }

    public function getFirstAndLast(): ?array
    {
        if ($this->getBusy() > 0) {
            $first = $this->queue[$this->getFirstKey()];
            $last = $this->queue[$this->getLastKey()];
            return [
                'first' => $first,
                'last' => $last
            ];
        }
        return null;
    }

}