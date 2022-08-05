<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid as GeneratorUuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

class Company extends Model
{
    protected $table = 'mst_companies';
    protected $primaryKey = 'comp_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'comp_ub_id',
        'comp_name',
        'comp_address',
        'comp_prov_code',
        'comp_reg_code',
        'comp_postal_code',
        'comp_email',
        'comp_website',
        'comp_phone',
        'comp_phone_alt',
        'comp_fax',
        'comp_curr_id',
        'comp_logo',
        'comp_enabled',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'comp_uuid'
    ];

    protected $dates = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            try {
                $model->comp_uuid = GeneratorUuid::uuid4()->toString();
            } catch (UnsatisfiedDependencyException $ude) {
                abort(500, $ude->getMessage());
            }
        });
    }

    public function provinsi()
    {
        return $this->belongsTo('App\Models\Reference\Province', 'comp_prov_code', 'prov_code');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\Reference\Region', 'reg_code', 'comp_reg_code');
    }
}
