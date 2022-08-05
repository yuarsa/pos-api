<?php

$router->group([
    'prefix' => 'dashboard',
    'namespace' => 'Dashboard',
    'middleware' => ['accept-header']
], function () use ($router) {

    $router->get('', 'DashboardController@index');
});