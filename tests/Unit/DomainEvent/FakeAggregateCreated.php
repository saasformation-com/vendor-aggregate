<?php

namespace SaaSFormation\Vendor\Aggregate\Tests\Unit\DomainEvent;

use SaaSFormation\Vendor\Aggregate\AbstractDomainEvent;

class FakeAggregateCreated extends AbstractDomainEvent
{
    public function version(): int
    {
        return 1;
    }

    public function code(): string
    {
        return 'FAKE_AGGREGATE_CREATED';
    }

    public function dataHolderClass(): ?string
    {
        return FakeAggregateCreatedDataHolder::class;
    }
}
