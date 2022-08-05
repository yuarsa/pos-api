<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class BusinessUnit extends Model
{
    protected $table = 'ref_unit_business';
    protected $primaryKey = 'ub_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ub_name',
        'ub_description',
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];
}
