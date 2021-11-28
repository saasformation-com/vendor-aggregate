<?php

namespace SaaSFormation\Vendor\Aggregate\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SaaSFormation\Vendor\Aggregate\ApplierService;
use SaaSFormation\Vendor\Aggregate\Tests\Unit\DomainEvent\FakeAggregateCreated;
use SaaSFormation\Vendor\Aggregate\Tests\Unit\DomainEvent\FakeAggregateCreatedDataHolder;
use StraTDeS\VO\Single\Name;
use StraTDeS\VO\Single\UUIDV1;

class ApplierServiceTest extends TestCase
{
    public function testApplyFakeAggregateCreatedDomainEventToAnEmptyFakeAggregateReturnProperAggregate(): void
    {
        // Arrange
        $aggregate = new \ReflectionClass(FakeAggregate::class);
        $aggregate = $aggregate->newInstanceWithoutConstructor();
        /** @var FakeAggregate $aggregate */

        // Act
        $id = UUIDV1::generate();
        $name = Name::fromValue("name");
        ApplierService::apply(
            FakeAggregateCreated::fire(
                $id,
                FakeAggregateCreatedDataHolder::create(
                    $name
                )
            ),
            $aggregate
        );

        // Assert
        $this->assertEquals($id, $aggregate->id());
        $this->assertEquals($name, $aggregate->name());
    }
}
