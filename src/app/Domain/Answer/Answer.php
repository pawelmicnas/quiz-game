<?php

declare(strict_types=1);

namespace Quiz\Domain\Answer;

class Answer implements AnswerInterface
{
    public function __construct(
        private int|null $id = null,
        private readonly string $content,
        private readonly bool $isCorrect,
    ) {
    }

    public function identifier(): string
    {
        return (string)$this->id;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function isCorrect(): bool
    {
        return $this->isCorrect;
    }
}