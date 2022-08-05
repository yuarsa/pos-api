<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'ref_provinces';
    protected $primaryKey = 'prov_code';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'prov_code', 'prov_name',
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    public function regions()
    {
        return $this->hasMany('App\Models\Reference\Region', 'reg_prov_code', 'prov_code');
    }
}
