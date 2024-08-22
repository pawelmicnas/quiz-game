<?php

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return static function (RoutingConfigurator $routes): void {
    $routes->import('../app/**/Controller/*', 'attribute',);

    $routes
        ->import('../app/**/Rest/*', 'attribute',)
        ->prefix('/rest')
        ->namePrefix('rest_');
};