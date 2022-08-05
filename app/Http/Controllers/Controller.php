<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\Traits\JsonResponseTrait;
use League\Fractal\Manager;

class Controller extends BaseController
{
    use JsonResponseTrait;

    public function __construct()
    {
        $fractal = new Manager();

        $this->fractal = $fractal;
        
        $this->setFractal($this->fractal);
    }
}