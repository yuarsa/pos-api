<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid as GeneratorUuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

class Product extends Model
{
    protected $table = 'mst_products';
    protected $primaryKey = 'prod_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'prod_uuid',
        'prod_company_id',
        'prod_outlet_id',
        'prod_category_id',
        'prod_merk_id',
        'prod_name',
        'prod_sku',
        'prod_unit',
        'prod_description',
        'prod_price_sell',
        'prod_price_purchase',
        'prod_serial',
        'prod_barcode',
        'prod_stock',
        'prod_image',
        'prod_is_sell',
        'prod_enabled',
        'prod_in_stock',
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            try {
                $model->prod_uuid = GeneratorUuid::uuid4()->toString();
            } catch (UnsatisfiedDependencyException $ude) {
                abort(500, $ude->getMessage());
            }
        });
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Master\Company', 'prod_company_id', 'comp_id');
    }

    public function outlet()
    {
        return $this->belongsTo('App\Models\Master\Outlet', 'prod_outlet_id', 'out_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Master\ProductCategory', 'prod_category_id', 'prodcat_id');
    }

    public function merk()
    {
        return $this->belongsTo('App\Models\Master\ProductMerk', 'prod_merk_id', 'prodmerk_id');
    }
    public function prodvar()
    {

        return $this->hasMany('App\Models\Master\ProductVarian', 'prodvar_product_id','prod_id' );

    }

    public function productWholesaler()
    {
        return $this->hasMany('App\Models\Master\ProductWholesaler', 'prodwho_product_id','prod_id' );
    }


    public function productVariants()
    {

       return $this->belongsTo(VarianValue::class);

    }
}
