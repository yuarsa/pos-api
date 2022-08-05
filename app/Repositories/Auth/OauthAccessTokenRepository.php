<?php

namespace App\Repositories\Auth;

use App\Repositories\BaseRepository;
use App\Contracts\Auth\OauthAccessTokenContract;
use App\Models\Auth\OauthAccessToken;

class OauthAccessTokenRepository extends BaseRepository implements OauthAccessTokenContract
{
    public function __construct(OauthAccessToken $model)
    {
        $this->model = $model;
    }
}
