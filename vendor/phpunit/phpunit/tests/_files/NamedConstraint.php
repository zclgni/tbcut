<?php
use PHPUnit\Framework\Constraint\Constraint;

final class NamedConstraint extends Constraint
{
    /**
     * @var int
     */
    private $name;

    public static function fromName(string $name): self
    {
        $instance = new self();

        $instance->name = $name;

        return $instance;
    }

    public function matches($other): bool
    {
        return true;
    }

    public function toString(): string
    {
        return $this->name;
    }
}
