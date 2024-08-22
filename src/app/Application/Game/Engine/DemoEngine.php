<?php

declare(strict_types=1);

namespace Quiz\Application\Game\Engine;

use Quiz\Domain\Game\Game;
use Quiz\Domain\Game\GameInterface;
use Quiz\Domain\Question\QuestionRepositoryInterface;

class DemoEngine implements EngineInterface
{
    public function __construct(
        private readonly QuestionRepositoryInterface $repository,
    ) {
    }

    public function initialize(): GameInterface
    {
        $game = new Game();
        $questions = [
            $this->repository->get(1),
            $this->repository->get(2),
            $this->repository->get(3),
        ];

        $game->loadQuestions(...$questions);

        return $game;
    }
}