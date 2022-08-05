<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class ProductWholesaler extends Model
{
    protected $table = 'mst_product_wholesaler';
    protected $primaryKey = 'prodwho_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'prodwho_product_id',
        'prodwho_qty_min',
        'prodwho_qty_max',
        'prodwho_price',
        'prodwho_type',
        'prodwho_enabled',
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Master\Product', 'prodwho_product_id', 'prod_id');
    }
}
