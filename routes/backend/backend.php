<?php

$router->group(['middleware' => ['auth:api']], function () use ($router) {
    $folder = base_path('routes/backend');

    $files = scandir($folder);

    foreach ($files as $key => $f) {
        if (!in_array($f, array('.', '..', 'backend.php'))) {
            require $folder . '/' . $f;
        }
    }
});