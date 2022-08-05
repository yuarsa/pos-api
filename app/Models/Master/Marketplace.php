<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class Marketplace extends Model
{
    protected $table = 'mst_marketplaces';
    protected $primaryKey = 'market_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'market_outlet_id',
        'market_access_token',
        'market_store_id',
        'market_store_name',
        'market_type',
        'market_sync',
        'market_enabled',
        'market_last_sync',
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    public function outlet()
    {
        return $this->belongsTo('App\Models\Master\Outlet', 'market_outlet_id', 'out_id');
    }
}
