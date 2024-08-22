<?php

declare(strict_types=1);

namespace Quiz\Domain\Game;

enum GameStatus: int
{
    case INITIALIZED = 0;
    case STARTED = 1;
    case ENDED = 2;
}
