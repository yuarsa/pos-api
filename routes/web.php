<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'v1', 'namespace' => 'v1'], function () use ($router) {
    $router->get('image-product/{id}', 'CommonController@productImage');

    $router->group(['prefix' => 'auth', 'namespace' => 'Auth'], function () use ($router) {
        $router->post('login', 'LoginController@create');
        $router->post('login-kasir', 'LoginKasirController@create');
        $router->post('register', 'RegisterController@create');

        $router->group(['middleware' => ['auth:api', 'accept-header']], function () use ($router) {
            $router->get('detail', 'LoginController@detail');
            $router->get('detail-kasir', 'LoginKasirController@detail');
            $router->get('logout', 'LoginController@logout');
            $router->get('logout-kasir', 'LoginKasirController@logout');
        });
    });

    $router->group(['prefix' => 'reference', 'namespace' => 'Reference'], function() use ($router) {
        $router->get('business/autocomplete', 'BusinessUnitController@autocomplete');
    });

    require(base_path() . '/routes/backend/backend.php');
    require(base_path() . '/routes/pos/pos.php');
});
