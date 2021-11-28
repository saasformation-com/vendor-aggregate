<?php

namespace SaaSFormation\Vendor\Aggregate;

use StraTDeS\VO\Single\Id;
use StraTDeS\VO\Single\UUIDV1;

abstract class AbstractDomainEvent
{
    protected Id $eventId;
    protected Id $aggregateId;
    protected \DateTime $createdAt;
    protected ?DomainEventDataHolder $dataHolder;

    protected function __construct(
        Id                     $eventId,
        Id                     $aggregateId,
        \DateTime              $createdAt,
        ?DomainEventDataHolder $dataHolder
    )
    {
        $this->checkDataHolderIsValid($dataHolder);

        $this->eventId = $eventId;
        $this->aggregateId = $aggregateId;
        $this->createdAt = $createdAt;
        $this->dataHolder = $dataHolder;
    }

    public static function fire(
        Id                     $aggregateId,
        ?DomainEventDataHolder $dataHolder = null,
        ?Id                    $eventId = null,
        ?\DateTime             $createdAt = null,
    ): static
    {
        return new static($eventId ?? UUIDV1::generate(), $aggregateId, $createdAt ?? new \DateTime(), $dataHolder);
    }

    public function toArray(): array
    {
        return $this->dataHolder->toArray();
    }

    public function toJSON(): string
    {
        return json_encode($this->toArray());
    }

    public function eventId(): Id
    {
        return $this->eventId;
    }

    public function aggregateId(): Id
    {
        return $this->aggregateId;
    }

    public function dataHolder(): DomainEventDataHolder
    {
        return $this->dataHolder;
    }

    private function checkDataHolderIsValid(?DomainEventDataHolder $dataHolder): void
    {
        if (!$this->dataHolderClass() && $dataHolder) {
            throw new InvalidDataHolderForDomainEventException(
                "Data holder must be null. You passed an instance of " . get_class($dataHolder)
            );
        }
        if ($this->dataHolderClass() !== null && get_class($dataHolder) !== $this->dataHolderClass()) {
            throw new InvalidDataHolderForDomainEventException(
                get_class($dataHolder) . "is an invalid data holder class. Required: " . $this->dataHolderClass()
            );
        }
    }

    public abstract function version(): int;

    public abstract function code(): string;

    public abstract function dataHolderClass(): ?string;
}
