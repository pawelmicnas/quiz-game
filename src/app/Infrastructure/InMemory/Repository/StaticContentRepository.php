<?php

declare(strict_types=1);

namespace Quiz\Infrastructure\InMemory\Repository;

use Quiz\Domain\Answer\Answer;
use Quiz\Domain\Question\Question;
use Quiz\Domain\Question\QuestionInterface;
use Quiz\Domain\Question\QuestionRepositoryInterface;
use Quiz\Domain\Question\QuestionStatus;
use Quiz\Domain\Question\QuestionType;

class StaticContentRepository implements QuestionRepositoryInterface
{
    private array $questions = [];

    /**
     * Constructor should not contain logic, it is for demo purposes
     */
    public function __construct()
    {
        $question = new Question(1, 'What is the result of this expression in PHP: print(-8-(-(-"3")));', QuestionStatus::PUBLISHED, QuestionType::ONE_ANSWER);
        $question->addAnswer(new Answer(1, '-11', true));
        $question->addAnswer(new Answer(2, '\'-11\'', false));
        $question->addAnswer(new Answer(3, '5', false));
        $question->addAnswer(new Answer(4, '\'5\'', false));
        $this->save($question);

        $question = new Question(2, 'Constructor promoted properties are available since php7.4 - true or false?', QuestionStatus::PUBLISHED, QuestionType::ONE_ANSWER);
        $question->addAnswer(new Answer(1, 'True', false));
        $question->addAnswer(new Answer(2, 'False', true));
        $this->save($question);

        $question = new Question(3, 'JIT stands for:', QuestionStatus::PUBLISHED, QuestionType::ONE_ANSWER);
        $question->addAnswer(new Answer(1, 'It is not JIT, it\'s JET', false));
        $question->addAnswer(new Answer(2, 'Just In Time compilation', true));
        $question->addAnswer(new Answer(3, 'Jira IT software', false));
        $this->save($question);
    }

    public function get(int $id): QuestionInterface
    {
        return $this->questions[$id];
    }

    public function save(QuestionInterface $question): void
    {
        $this->questions[$question->identifier()] = $question;
    }
}