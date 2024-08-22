<?php

namespace Quiz\Domain\Game;

use Quiz\Domain\Answer\AnswerInterface;
use Quiz\Domain\Player\PlayerInterface;
use Quiz\Domain\Question\QuestionInterface;

interface GameInterface
{
    /**
     * @throws GameDomainExceptionInterface
     */
    public function setPlayer(PlayerInterface $player): void;

    /**
     * @throws GameDomainExceptionInterface
     */
    public function loadQuestions(QuestionInterface ...$questions): void;

    public function hasQuestions(): bool;

    /**
     * @throws GameDomainExceptionInterface
     */
    public function play(): void;

    /**
     * @throws GameDomainExceptionInterface
     */
    public function end(): void;

    /**
     * @throws GameDomainExceptionInterface
     */
    public function displayQuestion(): QuestionInterface;

    /**
     * @throws GameDomainExceptionInterface
     */
    public function validateAnswer(QuestionInterface $question, AnswerInterface $answer): bool;

    /**
     * @throws GameDomainExceptionInterface
     */
    public function score(): int;
}