<?php

namespace SaaSFormation\Vendor\Aggregate;

abstract class DomainEventDataHolder
{
    public abstract function toArray(): array;

    public function get(string $key): mixed
    {

    }
}
