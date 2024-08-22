<?php

namespace Quiz\Domain\Answer;

interface AnswerInterface
{
    public function identifier(): string;
    public function getContent(): string;
    public function isCorrect(): bool;
}