<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class VarianValue extends Model
{
    protected $table = 'mst_variant_values';
    protected $primaryKey = 'val_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'val_id', 'val_variant_id', 'val_value', 'val_variant_id_2', 'val_value_2'
    ];

    protected $hidden = [
        'val_id'
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    public function varian()
    {
        return $this->belongsTo('App\Models\Master\VarianValue', 'val_id', 'val_value');
    }

    public function products()
    {
        return $this->belongsTo('App\Models\Master\Product', 'val_variant_id', 'prod_id');
    }

    public function varian_1()
    {
        return $this->belongsTo('App\Models\Master\Varian', 'val_variant_id', 'vars_id');
    }

    public function varian_2()
    {
        return $this->belongsTo('App\Models\Master\Varian', 'val_variant_id_2', 'vars_id');
    }

}
