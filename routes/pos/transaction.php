<?php

$router->group([
    'prefix' => 'pos',
    'namespace' => 'Pos',
    'middleware' => ['accept-header']
], function () use ($router) {
    $router->post('transactions', 'TransactionController@checkout');
    $router->get('transactions/{uuid}', 'TransactionController@getCheckout');
    $router->put('transactions/{uuid}', 'TransactionController@payment');

    $router->post('modal', 'TransactionController@modal');
    $router->get('modal/{uuid}', 'TransactionController@getModal');

    $router->get('report', 'ReportController@getreport');
    $router->get('report/{uuid}', 'ReportController@show');

    $router->get('kasir', 'ReportController@getrkasir');

    $router->post('kasir/filter', 'ReportController@filter');
});