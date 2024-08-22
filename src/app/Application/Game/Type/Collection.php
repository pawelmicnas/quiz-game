<?php

declare(strict_types=1);

namespace Quiz\Application\Game\Type;

class Collection
{
    /**
     * @param iterable<GameTypeInterface> $types
     */
    public function __construct(
        private readonly iterable $types,
    ){
    }

    public function all(): iterable
    {
        return $this->types;
    }
}