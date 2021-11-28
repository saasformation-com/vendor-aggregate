<?php

namespace SaaSFormation\Vendor\Aggregate;

abstract class AbstractAggregate
{
    private DomainEventStream $domainEventStream;

    protected function __construct()
    {
        $this->resetEventStream();
    }

    protected function record(AbstractDomainEvent $domainEvent): void
    {
        $this->domainEventStream->add($domainEvent);
    }

    public function pullEventStream(): DomainEventStream
    {
        $domainEventStream = $this->domainEventStream;

        $this->resetEventStream();

        return $domainEventStream;
    }

    protected function apply(AbstractDomainEvent $domainEvent): void
    {
        ApplierService::apply($domainEvent, $this);
    }

    private function resetEventStream(): void
    {
        $this->domainEventStream = DomainEventStream::create();
    }
}
