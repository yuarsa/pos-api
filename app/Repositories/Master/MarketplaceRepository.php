<?php

namespace App\Repositories\Master;

use App\Repositories\BaseRepository;
use App\Contracts\Master\MarketplaceContract;
use App\Models\Master\Marketplace;

class MarketplaceRepository extends BaseRepository implements MarketplaceContract
{
    public function __construct(Marketplace $model)
    {
        $this->model = $model;
    }
}
