<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid as GeneratorUuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

class Customer extends Model
{
    protected $table = 'mst_customers';
    protected $primaryKey = 'cus_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cus_uuid',
        'cus_comp_id',
        'cus_code',
        'cus_name',
        'cus_birthday',
        'cus_email',
        'cus_phone',
        'cus_address',
        'cus_prov_code',
        'cus_reg_code',
        'cus_postal_code',
        'cus_enabled',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    // protected $hidden = [
    //     'cus_uuid'
    // ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            try {
                $model->cus_uuid = GeneratorUuid::uuid4()->toString();
            } catch (UnsatisfiedDependencyException $ude) {
                abort(500, $ude->getMessage());
            }
        });
    }
}
