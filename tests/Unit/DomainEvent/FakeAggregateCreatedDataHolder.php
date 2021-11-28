<?php

namespace SaaSFormation\Vendor\Aggregate\Tests\Unit\DomainEvent;

use SaaSFormation\Vendor\Aggregate\DomainEventDataHolder;
use StraTDeS\VO\Single\Name;

class FakeAggregateCreatedDataHolder extends DomainEventDataHolder
{
    const NAME = 'name';

    private Name $name;

    private function __construct(Name $name)
    {
        $this->name = $name;
    }

    public static function create(Name $name): static
    {
        return new static($name);
    }

    public function toArray(): array
    {
        return [
            self::NAME => $this->name->value()
        ];
    }
}
