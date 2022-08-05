<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'ref_regencies';
    protected $primaryKey = 'reg_code';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reg_code', 'reg_prov_code', 'reg_name'
    ];

    protected $hidden = [
        'reg_code'
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    public function province()
    {
        return $this->belongsTo('App\Models\Reference\Province', 'reg_prov_code', 'prov_code');
    }
}
