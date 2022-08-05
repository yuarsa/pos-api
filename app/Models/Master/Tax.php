<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid as GeneratorUuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

class Tax extends Model
{
    protected $table = 'mst_taxes';
    protected $primaryKey = 'tax_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tax_comp_id',
        'tax_name',
        'tax_rate',
        'tax_enabled'
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            try {
                $model->tax_id = GeneratorUuid::uuid4()->toString();
            } catch (UnsatisfiedDependencyException $ude) {
                abort(500, $ude->getMessage());
            }
        });
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Master\Company', 'tax_comp_id', 'comp_id');
    }
}
