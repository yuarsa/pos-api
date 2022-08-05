<?php

namespace App\Repositories\Auth;

use App\Repositories\BaseRepository;
use App\Contracts\Auth\UserContract;
use App\Models\Auth\User;

class UserRepository extends BaseRepository implements UserContract
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }
}
