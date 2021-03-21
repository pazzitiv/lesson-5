<?php


namespace Monad;


class Monad
{
    public Monad $parent;

    private $value;

    public function apply($value): static
    {
        $this->parent = clone $this;
        $this->value = $value;

        return $this;
    }

    public function map(callable $func): static
    {
        $this->parent = clone $this;

        $this->value = $func($this->value);

        return $this;
    }

    public function __toString() {
        return $this->value;
    }
}