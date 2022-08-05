<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid as GeneratorUuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

class Employee extends Model
{
    protected $table = 'mst_employees';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey = 'emp_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'emp_out_id',
        'emp_type',
        'emp_name',
        'emp_email',
        'emp_phone',
        'emp_pin',
        'emp_enabled',
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
                $model->emp_id = GeneratorUuid::uuid4()->toString();
            } catch (UnsatisfiedDependencyException $ude) {
                abort(500, $ude->getMessage());
            }
        });
    }

    public function outlet()
    {
        return $this->belongsTo('App\Models\Master\Outlet', 'emp_out_id', 'out_id');
    }
}
