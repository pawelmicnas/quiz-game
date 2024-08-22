<?php

declare(strict_types=1);

namespace Quiz\Application\Game;

use Quiz\Application\Game\Engine\EngineInterface;
use Quiz\Application\Game\Exception\ApplicationException;

class Registry
{
    /**
     * @param array<EngineInterface> $engines
     */
    public function __construct(private array $engines)
    {}

    /**
     * @throws ApplicationException
     */
    public function getEngine(string $name): EngineInterface
    {
        if (!isset($this->engines[$name])) {
            throw new ApplicationException('Engine "' . $name . '" not found');
        }

        return $this->engines[$name];
    }
}