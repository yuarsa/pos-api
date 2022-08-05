<?php

$router->group([
    'prefix' => 'pos',
    'namespace' => 'Pos',
    'middleware' => ['accept-header']
], function () use ($router) {
    $router->get('products', 'ProductController@getProductPerCategory');
    $router->get('productsvariant/{id}', 'ProductController@getProductVariant');
});