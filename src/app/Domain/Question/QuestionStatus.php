<?php

declare(strict_types=1);

namespace Quiz\Domain\Question;

enum QuestionStatus: int
{
    case PRIVATE = 0;
    case PUBLISHED = 1;
}
