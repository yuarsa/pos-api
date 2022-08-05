<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid as GeneratorUuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

class PurchaseOrderDetail extends Model
{
    protected $table = 'trx_purchase_order_detail';
    protected $primaryKey = 'pod_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pod_uuid',
        'pod_po_id',
        'pod_product_id',
        'pod_description',
        'pod_qty',
        'pod_price',
        'pod_tax',
        'pod_total',
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            try {
                $model->pod_uuid = GeneratorUuid::uuid4()->toString();
            } catch (UnsatisfiedDependencyException $ude) {
                abort(500, $ude->getMessage());
            }
        });
    }

    public function purchase()
    {
        return $this->belongsTo('App\Models\Transaction\PurchaseOrder', 'pod_po_id', 'po_id');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Master\Product', 'pod_product_id', 'prod_id');
    }
}
