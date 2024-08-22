<?php

declare(strict_types=1);

namespace Quiz\Domain\Question;

use Exception;

class QuestionDomainException extends Exception implements QuestionDomainExceptionInterface
{
}