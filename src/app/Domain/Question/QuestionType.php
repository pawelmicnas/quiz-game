<?php

declare(strict_types=1);

namespace Quiz\Domain\Question;

enum QuestionType: int
{
    case ONE_ANSWER = 1;
    case MULTISELECT = 2;
}
