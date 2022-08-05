<?php

namespace App\Transformer\v1\Master;

use League\Fractal\TransformerAbstract;
use App\Models\Master\Marketplace;

class MarketplaceTransformer extends TransformerAbstract
{
    public function transform(Marketplace $marketplace)
    {
        if($marketplace->outlet) {
            $outlet = [
                'id' => $marketplace->outlet->out_id,
                'name' => $marketplace->outlet->out_name,
            ];
        } else {
            $outlet = [];
        }

        $formatted = [
            'id' => $marketplace->market_id,
            'outlet' => $outlet,
            'store_id' => $marketplace->market_store_id,
            'store_name' => $marketplace->market_store_name,
            'token' => $marketplace->market_access_token,
            'type' => $marketplace->market_type,
            'sync' => $marketplace->market_sync,
            'enabled' => $marketplace->market_enabled,
            'last_sync' => (String) $marketplace->market_last_sync,
            'created' => (String) $marketplace->created_at,
            'updated' => (String) $marketplace->updated_at,
        ];

        return $formatted;
    }
}
