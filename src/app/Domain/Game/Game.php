<?php

declare(strict_types=1);

namespace Quiz\Domain\Game;

use Quiz\Domain\Answer\AnswerInterface;
use Quiz\Domain\Player\PlayerInterface;
use Quiz\Domain\Question\QuestionInterface;

class Game implements GameInterface
{
    private PlayerInterface $player;
    private array|null $questions = null;
    private GameStatus $status;

    public function __construct(
        private int $score = 0,
    ) {
        $this->status = GameStatus::INITIALIZED;
    }

    /**
     * @inheritDoc
     */
    public function setPlayer(PlayerInterface $player): void
    {
        $this->player = $player;
    }

    /**
     * @inheritDoc
     */
    public function loadQuestions(QuestionInterface ...$questions): void
    {
        if (null !== $this->questions) {
            throw new GameDomainException('Questions already loaded.');
        }

        foreach ($questions as $question) {
            $this->questions[] = $question;
        }
    }

    public function hasQuestions(): bool
    {
        return !empty($this->questions);
    }

    /**
     * @inheritDoc
     */
    public function play(): void
    {
        $this->status = GameStatus::STARTED;
    }

    /**
     * @inheritDoc
     */
    public function end(): void
    {
        if ($this->status === GameStatus::ENDED) {
            throw new GameDomainException('Can not end already ended game.');
        }

        $this->status = GameStatus::ENDED;
    }

    /**
     * @inheritDoc
     */
    public function displayQuestion(): QuestionInterface
    {
        if ($this->status === GameStatus::INITIALIZED) {
            throw new GameDomainException('Game has not been started.');
        }

        if ($this->status === GameStatus::ENDED) {
            throw new GameDomainException('Game has been ended.');
        }

        if (!$this->hasQuestions()) {
            throw new GameDomainException('No questions loaded.');
        }

        return array_shift($this->questions);
    }

    /**
     * @inheritDoc
     */
    public function validateAnswer(QuestionInterface $question, AnswerInterface $answer): bool
    {
        if ($answer->isCorrect()) {
            $this->addPoint();
        }

        return $answer->isCorrect();
    }

    /**
     * @inheritDoc
     */
    public function score(): int
    {
        return $this->score;
    }

    /**
     * @throws GameDomainException
     */
    private function addPoint(): void
    {
        if ($this->status === GameStatus::INITIALIZED) {
            throw new GameDomainException('Game has not been started.');
        }

        if ($this->status === GameStatus::ENDED) {
            throw new GameDomainException('Can not add points in ended game.');
        }

        $this->score++;
    }
}