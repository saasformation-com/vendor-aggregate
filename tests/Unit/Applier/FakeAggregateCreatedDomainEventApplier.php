<?php

namespace SaaSFormation\Vendor\Aggregate\Tests\Unit\Applier;

use SaaSFormation\Vendor\Aggregate\AbstractDomainEvent;
use SaaSFormation\Vendor\Aggregate\DomainEventApplier;
use StraTDeS\VO\Single\Name;

class FakeAggregateCreatedDomainEventApplier extends DomainEventApplier
{
    public function apply(AbstractDomainEvent $domainEvent): void
    {
        $this->setValue('id', $domainEvent->aggregateId());
        $this->setValue('name', Name::fromValue($domainEvent->toArray()['name']));
    }
}
