<?php

namespace Quiz\Application\Game\Type;

interface GameTypeInterface
{
    public function identifier(): string;

    public function name(): string;

    public function description(): string;
}