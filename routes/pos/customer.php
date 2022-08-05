<?php

$router->group([
    'prefix' => 'pos',
    'namespace' => 'Pos',
    'middleware' => ['accept-header']
], function () use ($router) {
    $router->get('customers/{company_id}', 'CustomerController@index');
    $router->post('customers', 'CustomerController@store');
});