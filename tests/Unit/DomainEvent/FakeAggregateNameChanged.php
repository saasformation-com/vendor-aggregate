<?php

namespace SaaSFormation\Vendor\Aggregate\Tests\Unit\DomainEvent;

use SaaSFormation\Vendor\Aggregate\AbstractDomainEvent;

class FakeAggregateNameChanged extends AbstractDomainEvent
{
    public function version(): int
    {
        return 1;
    }

    public function code(): string
    {
        return 'FAKE_AGGREGATE_NAME_CHANGED';
    }

    public function dataHolderClass(): ?string
    {
        return FakeAggregateNameChangedDataHolder::class;
    }
}
