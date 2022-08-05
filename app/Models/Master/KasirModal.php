<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid as GeneratorUuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

class KasirModal extends Model
{
    protected $table = 'kasir_modal';
    protected $primaryKey = 'uuid';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'emp_id',
        'out_id',
        'comp_id',
        'saldo'
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            try {
                $model->uuid = GeneratorUuid::uuid4()->toString();
            } catch (UnsatisfiedDependencyException $ude) {
                abort(500, $ude->getMessage());
            }
        });
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Master\Company', 'comp_id', 'comp_uuid');
    }

    public function outlet()
    {
        return $this->belongsTo('App\Models\Master\Outlet', 'out_id', 'out_id');
    }

    public function employee()
    {
        return $this->belongsTo('App\Models\Master\Employee', 'emp_id', 'emp_id');
    }
}
