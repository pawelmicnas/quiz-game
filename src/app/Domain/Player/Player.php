<?php

declare(strict_types=1);

namespace Quiz\Domain\Player;

class Player implements PlayerInterface
{
    public function __construct(
        private readonly int|null $id = null,
        private readonly string $username,
    ) {
    }

    public function username(): string
    {
        return $this->username;
    }
}