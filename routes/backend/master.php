<?php

$router->group([
    'prefix' => 'master',
    'namespace' => 'Master',
    'middleware' => ['accept-header']
], function () use ($router) {
    $router->get('outlets', 'OutletController@index');
    $router->get('outlets/autocomplete', 'OutletController@autocomplete');
    $router->post('outlets', 'OutletController@store');
    $router->get('outlets/{uuid}', 'OutletController@show');
    $router->put('outlets/{uuid}', 'OutletController@update');
    $router->delete('outlets/{uuid}', 'OutletController@destroy');

    $router->get('customers', 'CustomerController@index');
    $router->get('customers/autocomplete', 'CustomerController@autocomplete');
    $router->post('customers', 'CustomerController@store');
    $router->get('customers/{uuid}', 'CustomerController@show');
    $router->put('customers/{uuid}', 'CustomerController@update');
    $router->delete('customers/{uuid}', 'CustomerController@destroy');

    $router->get('suppliers', 'SupplierController@index');
    $router->get('suppliers/autocomplete', 'SupplierController@autocomplete');
    $router->post('suppliers', 'SupplierController@store');
    $router->get('suppliers/{uuid}', 'SupplierController@show');
    $router->put('suppliers/{uuid}', 'SupplierController@update');
    $router->delete('suppliers/{uuid}', 'SupplierController@destroy');

    $router->get('taxes', 'TaxController@index');
    $router->post('taxes', 'TaxController@store');
    $router->get('taxes/{id}', 'TaxController@show');
    $router->put('taxes/{id}', 'TaxController@update');
    $router->delete('taxes/{id}', 'TaxController@destroy');

    $router->get('marketplaces', 'MarketplaceController@index');
    $router->post('marketplaces', 'MarketplaceController@store');
    $router->get('marketplaces/{id}', 'MarketplaceController@show');
    $router->put('marketplaces/{id}', 'MarketplaceController@update');
    $router->delete('marketplaces/{id}', 'MarketplaceController@destroy');

    $router->get('merks', 'ProductMerkController@index');
    $router->post('merks', 'ProductMerkController@store');
    $router->get('merks/{id}', 'ProductMerkController@show');
    $router->put('merks/{id}', 'ProductMerkController@update');
    $router->delete('merks/{id}', 'ProductMerkController@destroy');

    $router->get('categories', 'ProductCategoryController@index');
    $router->get('categories/autocomplete', 'ProductCategoryController@autocomplete');
    $router->get('categories/parent', 'ProductCategoryController@getParentCategory');
    $router->get('categories/child/{id}', 'ProductCategoryController@getChildrenCategory');
    $router->post('categories', 'ProductCategoryController@store');
    $router->get('categories/{id}', 'ProductCategoryController@show');
    $router->put('categories/{id}', 'ProductCategoryController@update');
    $router->delete('categories/{id}', 'ProductCategoryController@destroy');

    $router->get('employees', 'EmployeeController@index');
    $router->post('employees', 'EmployeeController@store');
    $router->get('employees/{id}', 'EmployeeController@show');
    $router->put('employees/{id}', 'EmployeeController@update');
    $router->put('employees/saldo/{id}', 'EmployeeController@updateSaldo');
    $router->delete('employees/{id}', 'EmployeeController@destroy');

    $router->get('company/show/{id}', 'CompanyController@index');
    $router->get('company/{id}', 'CompanyController@show');
    $router->put('company/{id}', 'CompanyController@update');

    $router->get('varian', 'VarianController@index');
    // $router->get('varian/autocomplete', 'VarianController@autocomplete');
    // $router->post('varian', 'VarianController@store');
    // $router->get('varian/{id}', 'VarianController@show');
    // $router->put('varian/{id}', 'VarianController@update');
    // $router->delete('varian/{id}', 'VarianController@destroy');


     // $router->get('varianvalue', 'VarianValueController@index');
    // $router->get('varian/autocomplete', 'VarianController@autocomplete');
    // $router->post('varianvalue', 'VarianValueController@store');
    // $router->get('varianvalue/{id}', 'VarianValueController@show');
    // $router->put('varianvalue/{id}', 'VarianValueController@update');
    // $router->delete('varianvalue/{id}', 'VarianValueController@destroy');

    $router->get('dashboard', 'DashboardController@index');
});

$router->group([
    'prefix' => 'master',
    'namespace' => 'Master'
], function () use ($router) {
    $router->get('products', 'ProductController@index');
    $router->get('products/autocomplete', 'ProductController@autocomplete');
    $router->get('products/{id}', 'ProductController@show');
    $router->post('products', 'ProductController@store');
    $router->get('products/{id}', 'ProductController@show');
    $router->put('products/{id}', 'ProductController@update');
    $router->delete('products/{id}', 'ProductController@destroy');
    $router->put('products/status/{id}', 'ProductController@setStatusProduct');



    $router->get('productvarianmaster', 'ProductVarianController@index');
    // $router->get('products/autocomplete', 'ProductController@autocomplete');
    // $router->get('products/{id}', 'ProductController@show');
    // $router->post('products', 'ProductController@store');
    // $router->get('products/{id}', 'ProductController@show');
    // $router->put('products/{id}', 'ProductController@update');
    // $router->delete('products/{id}', 'ProductController@destroy');
    // $router->put('products/status/{id}', 'ProductController@setStatusProduct');
});
