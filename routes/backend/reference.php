<?php

$router->group([
    'prefix' => 'reference',
    'namespace' => 'Reference'
], function () use ($router) {
    $router->get('business', 'BusinessUnitController@index');
    $router->post('business', 'BusinessUnitController@store');
    $router->get('business/{id}', 'BusinessUnitController@show');
    $router->put('business/{id}', 'BusinessUnitController@update');
    $router->delete('business/{id}', 'BusinessUnitController@destroy');

    $router->get('provinces', 'ProvinceController@index');
    $router->get('provinces/autocomplete', 'ProvinceController@autocomplete');
    $router->post('provinces', 'ProvinceController@store');
    $router->get('provinces/{id}', 'ProvinceController@show');
    $router->put('provinces/{id}', 'ProvinceController@update');
    $router->delete('provinces/{id}', 'ProvinceController@destroy');

    $router->get('regions', 'RegionController@index');
    $router->post('regions', 'RegionController@store');
    $router->get('regions/{id}', 'RegionController@show');
    $router->put('regions/{id}', 'RegionController@update');
    $router->delete('regions/{id}', 'RegionController@destroy');
    $router->get('regions/autocomplete/{id}', 'RegionController@autocomplete');

    $router->get('payterms', 'PaymentTermController@index');
    $router->get('payterms/autocomplete', 'PaymentTermController@autocomplete');
    $router->post('payterms', 'PaymentTermController@store');
    $router->get('payterms/{id}', 'PaymentTermController@show');
    $router->put('payterms/{id}', 'PaymentTermController@update');
    $router->delete('payterms/{id}', 'PaymentTermController@destroy');
});
