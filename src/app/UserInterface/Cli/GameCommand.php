<?php

declare(strict_types=1);

namespace Quiz\UserInterface\Cli;

use Quiz\Application\Game\Exception\ApplicationException;
use Quiz\Application\Game\Registry;
use Quiz\Application\Game\Type\Collection;
use Quiz\Domain\Question\QuestionInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand('game:play')]
class GameCommand extends Command
{
    public function __construct(
        private readonly Collection $collection,
        private readonly Registry $registry,
    ){
        parent::__construct();
    }

    /**
     * @throws ApplicationException
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $type = $io->askQuestion(new ChoiceQuestion('Choose the game type: ', $this->parseTypes()));
        $engine = $this->registry->getEngine($type);
        $game = $engine->initialize();
        $game->play();

        while ($game->hasQuestions()) {
            $question = $game->displayQuestion();
            [$answersParsed, $answers] = $this->parseAnswers($question);
            $answerContent = $io->askQuestion(new ChoiceQuestion($question->getContent(), $answersParsed));
            match ($game->validateAnswer($question, $answers[$answerContent])) {
                true => $io->writeln(sprintf('Correct! Your score is: %s', $game->score())),
                false => $io->writeln(sprintf('Wrong! Your score is: %s', $game->score())),
            };
        }

        $game->end();
        $io->success(sprintf('Game finished. Your score is: %s', $game->score()));

        return 0;
    }

    private function parseTypes(): array
    {
        $types = [];
        foreach ($this->collection->all() as $type) {
            $types[$type::class] = $type->name();
        }

        return $types;
    }

    private function parseAnswers(QuestionInterface $question): array
    {
        $answers = $answersParsed = [];
        foreach ($question->getAnswers() as $answer) {
            $answersParsed[$answer->identifier()] = $answer->getContent();
            $answers[$answer->getContent()] = $answer;
        }

        return [$answersParsed, $answers];
    }
}