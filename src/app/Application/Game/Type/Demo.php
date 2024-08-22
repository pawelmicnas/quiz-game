<?php

declare(strict_types=1);

namespace Quiz\Application\Game\Type;

class Demo implements GameTypeInterface
{
    public function __construct(
        private readonly string $identifier,
        private readonly string $name,
        private readonly string $description,
    ) {
    }

    public function identifier(): string
    {
        return $this->identifier;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function description(): string
    {
        return $this->description;
    }
}