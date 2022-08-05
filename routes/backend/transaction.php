<?php

$router->group([
    'prefix' => 'transaction',
    'namespace' => 'Transaction',
    'middleware' => ['accept-header']
], function () use ($router) {
    $router->get('purchases', 'PurchaseOrderController@index');
    $router->get('purchases/autocomplete', 'PurchaseOrderController@autocomplete');
    $router->get('purchases/{uuid}', 'PurchaseOrderController@show');
    $router->post('purchases', 'PurchaseOrderController@store');
    $router->put('purchases/{uuid}', 'PurchaseOrderController@update');
    $router->delete('purchases/{uuid}', 'PurchaseOrderController@destroy');
    $router->put('purchases/status/{uuid}', 'PurchaseOrderController@setStatus');

    $router->get('receives', 'ReceivedOrderController@index');
    $router->get('receives/{uuid}', 'ReceivedOrderController@show');
    $router->post('receives', 'ReceivedOrderController@store');
    $router->put('receives/{uuid}', 'ReceivedOrderController@update');
    $router->delete('receives/{uuid}', 'ReceivedOrderController@destroy');
    $router->put('receives/status/{uuid}', 'ReceivedOrderController@setStatus');

    $router->get('sales', 'SaleOrderController@index');
    $router->get('sales/{uuid}', 'SaleOrderController@show');
    $router->post('sales', 'SaleOrderController@store');
    $router->put('sales/{uuid}', 'SaleOrderController@update');
    $router->delete('sales/{uuid}', 'SaleOrderController@destroy');
    $router->put('sales/status/{uuid}', 'SaleOrderController@setStatus');
});