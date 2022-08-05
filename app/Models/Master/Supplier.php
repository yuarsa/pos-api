<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid as GeneratorUuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

class Supplier extends Model
{
    protected $table = 'mst_suppliers';
    protected $primaryKey = 'sup_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sup_uuid',
        'sup_comp_id',
        'sup_code',
        'sup_name',
        'sup_birthday',
        'sup_email',
        'sup_phone',
        'sup_address',
        'sup_prov_code',
        'sup_reg_code',
        'sup_postal_code',
        'sup_contact',
        'sup_contact_phone',
        'sup_enabled'
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            try {
                $model->sup_uuid = GeneratorUuid::uuid4()->toString();
            } catch (UnsatisfiedDependencyException $ude) {
                abort(500, $ude->getMessage());
            }
        });
    }

    public function province()
    {
        return $this->belongsTo('App\Models\Reference\Province', 'sup_prov_code', 'prov_code');
    }

    public function region()
    {
        return $this->belongsTo('App\Models\Reference\Region', 'sup_reg_code', 'reg_code');
    }
}
