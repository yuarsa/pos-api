<?php

$router->group(['middleware' => ['auth:api']], function () use ($router) {
    $folder = base_path('routes/pos');

    $files = scandir($folder);

    foreach ($files as $key => $f) {
        if (!in_array($f, array('.', '..', 'pos.php'))) {
            require $folder . '/' . $f;
        }
    }
});