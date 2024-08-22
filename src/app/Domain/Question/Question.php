<?php

declare(strict_types=1);

namespace Quiz\Domain\Question;

use Quiz\Domain\Answer\AnswerInterface;

class Question implements QuestionInterface
{
    /**
     * @var array<AnswerInterface>
     */
    private array|null $answers = null;

    public function __construct(
        private int|null $id = null,
        private readonly string $content,
        private QuestionStatus $status,
        private readonly QuestionType $type,
    ) {
    }

    public function identifier(): string
    {
        return (string)$this->id;
    }

    public function getContent(): string
    {
        $this->validateStatus();

        return $this->content;
    }

    public function getAnswers(): array
    {
        $this->validateStatus();
        if (empty($this->answers)) {
            throw new QuestionDomainException('Question has no answers');
        }

        return $this->answers;
    }

    public function addAnswer(AnswerInterface $answer): void
    {
        $this->answers[$answer->identifier()] = $answer;
    }

    public function type(): QuestionType
    {
        return $this->type;
    }

    public function publish(): void
    {
        $this->status = QuestionStatus::PUBLISHED;
    }

    public function unpublish(): void
    {
        $this->status = QuestionStatus::PRIVATE;
    }

    public function isPublished(): bool
    {
        return $this->status === QuestionStatus::PUBLISHED;
    }

    /**
     * @throws QuestionDomainException
     */
    private function validateStatus(): void
    {
        if (!$this->isPublished()) {
            throw new QuestionDomainException('Question is not published');
        }
    }
}