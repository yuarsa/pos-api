<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
// use Ramsey\Uuid\Uuid as GeneratorUuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

class ProductVarian extends Model
{
    protected $table = 'mst_product_variants';
    protected $primaryKey = 'prodvar_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'prodvar_product_id',
        'prodvar_value_id',
        'prodvar_price',
        'prodvar_purchase_price',
        'prodvar_stock'
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];


public function varian()
    {
        return $this->hasMany('App\Models\Master\VarianValue','prodvar_value_id', 'val_id' );
        
    }
}
