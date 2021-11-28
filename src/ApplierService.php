<?php

namespace SaaSFormation\Vendor\Aggregate;

class ApplierService
{
    public static function apply(AbstractDomainEvent $domainEvent, AbstractAggregate &$aggregate): void
    {
        $domainEventFQCNParts = explode("\\", get_class($domainEvent));
        $domainEventFQCNParts = array_slice($domainEventFQCNParts, 0, count($domainEventFQCNParts) - 2);
        $namespace = implode("\\", $domainEventFQCNParts) . "\\Applier\\";
        $className = $namespace . substr(strrchr(get_class($domainEvent), '\\'), 1) . "DomainEventApplier";

        /** @var DomainEventApplier $applier */
        $applier = new $className($aggregate);

        $applier->apply($domainEvent);
    }
}
