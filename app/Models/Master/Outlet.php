<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid as GeneratorUuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

class Outlet extends Model
{
    protected $table = 'mst_outlets';
    protected $primaryKey = 'out_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'out_comp_id',
        'out_name',
        'out_email',
        'out_phone',
        'out_address',
        'out_prov_code',
        'out_reg_code'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'out_uuid'
    ];

    protected $dates = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            try {
                $model->out_uuid = GeneratorUuid::uuid4()->toString();
            } catch (UnsatisfiedDependencyException $ude) {
                abort(500, $ude->getMessage());
            }
        });
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Master\Company', 'out_comp_id', 'comp_id');
    }
    
    public function province()
    {
        return $this->belongsTo('App\Models\Reference\Province', 'out_prov_code', 'prov_code');
    }

    public function regency()
    {
        return $this->belongsTo('App\Models\Reference\Region', 'out_reg_code', 'reg_code');
    }
}
