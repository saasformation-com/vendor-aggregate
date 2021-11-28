<?php

namespace SaaSFormation\Vendor\Aggregate;

use StraTDeS\VO\Collection\AbstractCollection;

class DomainEventStream extends AbstractCollection
{
    protected function itemClass(): string
    {
        return AbstractDomainEvent::class;
    }
}
