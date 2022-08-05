<?php
    
namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid as GeneratorUuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

class Varian extends Model
{
    protected $table = 'mst_variants';
    protected $primaryKey = 'vars_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'vars_id',
        'vars_name',
        
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];


    // public function VarianDetail()
    // {
    //     return $this->belongsTo('App\Models\Master\Product', 'pod_product_id', 'prod_id');
    // }
}
