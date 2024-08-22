<?php

namespace Quiz\Domain\Question;

use Quiz\Domain\Answer\AnswerInterface;

interface QuestionInterface
{
    /**
     * Get identifier
     *
     * @return string
     */
    public function identifier(): string;

    /**
     * Get Question content
     *
     * @throws QuestionDomainExceptionInterface
     */
    public function getContent(): string;

    /**
     * Get array of all available Answers for Question
     *
     * @return array<AnswerInterface>
     * @throws QuestionDomainExceptionInterface
     */
    public function getAnswers(): array;

    /**
     * Add new Answer to Question
     *
     * @throws QuestionDomainExceptionInterface
     */
    public function addAnswer(AnswerInterface $answer): void;

    /**
     * Get information about Question Type
     */
    public function type(): QuestionType;

    /**
     * Change status of Question to published
     *
     * @throws QuestionDomainExceptionInterface
     */
    public function publish(): void;

    /**
     * Change status of Question to private
     *
     * @throws QuestionDomainExceptionInterface
     */
    public function unpublish(): void;

    /**
     * Check if Question is published or private
     */
    public function isPublished(): bool;
}