<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid as GeneratorUuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

class SaleDetail extends Model
{
    protected $table = 'trx_sale_detail';
    protected $primaryKey = 'saledet_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'saledet_uuid',
        'saledet_sale_id',
        'saledet_product_id',
        'saledet_qty',
        'saledet_price',
        'saledet_total',
        'saledet_discount_percent',
        'saledet_discount',
        'saledet_tax_id',
        'saledet_grand_total',
        "saledet_prodvar_id"
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            try {
                $model->saledet_uuid = GeneratorUuid::uuid4()->toString();
            } catch (UnsatisfiedDependencyException $ude) {
                abort(500, $ude->getMessage());
            }
        });
    }

    public function sale()
    {
        return $this->belongsTo('App\Models\Transaction\Sale', 'saledet_sale_id', 'sale_id');
    }

    public function tax()
    {
        return $this->belongsTo('App\Models\Master\Tax', 'saledet_tax_id', 'tax_id');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Master\Product', 'saledet_product_id', 'prod_id');
    }

    public function varian()
    {
        return $this->belongsTo('App\Models\Master\ProductVarian', 'saledet_prodvar_id', 'prodvar_id');
    }

}
