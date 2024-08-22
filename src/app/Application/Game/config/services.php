<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Quiz\Application\Game\Engine\DemoEngine;
use Quiz\Application\Game\Registry;
use Quiz\Application\Game\Type\Collection;
use Quiz\Application\Game\Type\Demo;
use Quiz\Infrastructure\InMemory\Repository\StaticContentRepository;

return static function (ContainerConfigurator $container): void {
    $services = $container->services();

    $services->set(Demo::class, Demo::class)
        ->arg('$identifier', 'demo')
        ->arg('$name', 'Demo')
        ->arg('$description', 'Demo mode - you get only one hardcoded question. No platinum trophy here.')
        ->tag('engine.type');

    $services->set(DemoEngine::class, DemoEngine::class)
        ->arg('$repository', service(StaticContentRepository::class));

    $services
        ->set(Collection::class, Collection::class)
        ->bind('iterable $types', tagged_iterator('engine.type'));

    $services
        ->set(Registry::class, Registry::class)
        ->arg('$engines', [
            Demo::class => service(DemoEngine::class),
        ]);
};