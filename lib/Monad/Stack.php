<?php


namespace Monad;


class Stack
{
    public ?Stack $parent = null;

    private array $stack = [];
    public $poped;

    public function apply(array $stack = []): static
    {
        $this->parent = clone $this;
        $this->stack = $stack;

        return $this;
    }

    public function push($value): static
    {
        $this->parent = clone $this;
        $this->stack[] = $value;

        return $this;
    }

    public function pop(): static
    {
        if($this->parent) {
            $this->parent->poped = end($this->stack);

            return $this->parent;
        }

        return $this;
    }

    public function len(): int
    {
        return count($this->stack);
    }

    public function __toString(): string
    {
        return implode(", ", $this->stack);
    }

    public function toArray(): array
    {
        return $this->stack;
    }
}