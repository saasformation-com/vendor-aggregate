<?php

namespace SaaSFormation\Vendor\Aggregate\Tests\Unit;

use SaaSFormation\Vendor\Aggregate\AbstractAggregate;
use StraTDeS\VO\Single\Id;
use StraTDeS\VO\Single\Name;

class FakeAggregate extends AbstractAggregate
{
    private Id $id;
    private Name $name;

    private function __construct(Id $id, Name $name)
    {
        parent::__construct();
    }

    public static function create(Id $id, Name $name): static
    {
        return new static($id, $name);
    }

    public function id(): Id
    {
        return $this->id;
    }

    public function name(): Name
    {
        return $this->name;
    }
}
