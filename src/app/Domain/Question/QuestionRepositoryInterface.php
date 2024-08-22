<?php

namespace Quiz\Domain\Question;

interface QuestionRepositoryInterface
{
    public function get(int $id): QuestionInterface;

    public function save(QuestionInterface $question): void;
}