<?php

namespace SaaSFormation\Vendor\Aggregate;

class ReconstitutionService
{
    public static function reconstitute(DomainEventStream $domainEventStream, string $aggregateClass): AbstractAggregate
    {
        $aggregate = new \ReflectionClass($aggregateClass);
        $aggregate = $aggregate->newInstanceWithoutConstructor();
        /** @var AbstractAggregate $aggregate */

        foreach($domainEventStream as $domainEvent) {
            ApplierService::apply($domainEvent, $aggregate);
        }

        return $aggregate;
    }
}
