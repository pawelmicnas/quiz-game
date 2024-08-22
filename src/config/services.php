<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Quiz\Application\Game\Engine\DemoEngine;
use Quiz\Application\Game\Registry;
use Quiz\Application\Game\Type\Demo;

return static function (ContainerConfigurator $container): void {
    $services = $container->services()
        ->defaults()
        ->autowire()
        ->autoconfigure();

    $services
        ->load('Quiz\\', '../app/')
        ->exclude(['../app/{DependencyInjection,Entity,Kernel.php}', '../app/**/config/*']);

    $services
        ->set(Registry::class, Registry::class)
        ->arg('$engines', [
            Demo::class => service(DemoEngine::class),
        ]);

    $container->import('../app/**/config/services.php');
};