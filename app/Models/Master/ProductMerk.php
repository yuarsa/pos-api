<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid as GeneratorUuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

class ProductMerk extends Model
{
    protected $table = 'mst_product_merks';
    protected $primaryKey = 'prodmerk_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'prodmerk_uuid',
        'prodmerk_company_id',
        'prodmerk_outlet_id',
        'prodmerk_name',
        'prodmerk_description',
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            try {
                $model->prodmerk_uuid = GeneratorUuid::uuid4()->toString();
            } catch (UnsatisfiedDependencyException $ude) {
                abort(500, $ude->getMessage());
            }
        });
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Master\Company', 'prodmerk_company_id', 'comp_id');
    }

    public function outlet()
    {
        return $this->belongsTo('App\Models\Master\Outlet', 'prodmerk_outlet_id', 'out_id');
    }
}
