<?php

declare(strict_types=1);

namespace Quiz\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Quiz\Domain\Question\Question;
use Quiz\Domain\Question\QuestionInterface;
use Quiz\Domain\Question\QuestionRepositoryInterface;

class QuestionRepository implements QuestionRepositoryInterface
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {}

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function get(int $id): QuestionInterface
    {
        return $this->entityManager->find(Question::class, $id);
    }

    public function save(QuestionInterface $question): void
    {
        $this->entityManager->persist($question);
        $this->entityManager->flush();
    }
}