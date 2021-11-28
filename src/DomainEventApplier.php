<?php

namespace SaaSFormation\Vendor\Aggregate;

abstract class DomainEventApplier
{
    private AbstractAggregate $aggregate;
    private \ReflectionClass $reflectedClass;

    public function __construct(AbstractAggregate &$aggregate)
    {
        $this->aggregate = $aggregate;
        $this->reflectedClass = new \ReflectionClass($aggregate);
    }

    public function setValue(string $valueKey, mixed $value): void
    {
        $reflectedProperty = $this->reflectedClass->getProperty($valueKey);
        $reflectedProperty->setAccessible(true);
        $reflectedProperty->setValue($this->aggregate, $value);
        $reflectedProperty->setAccessible(false);
    }

    public abstract function apply(AbstractDomainEvent $domainEvent): void;
}
