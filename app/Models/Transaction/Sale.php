<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid as GeneratorUuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

class Sale extends Model
{
    protected $table = 'trx_sale';
    protected $primaryKey = 'sale_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sale_uuid',
        'sale_type',
        'sale_outlet_id',
        'sale_code',
        'sale_date',
        'sale_cashier',
        'sale_customer_id',
        'sale_total',
        'sale_discount',
        'sale_tax_id',
        'sale_grant_total',
        'sale_payment_type',
        'sale_payment_amount',
        'sale_payment_balance',
        'sale_user_id',
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            try {
                $model->sale_uuid = GeneratorUuid::uuid4()->toString();
            } catch (UnsatisfiedDependencyException $ude) {
                abort(500, $ude->getMessage());
            }
        });
    }

    public function outlet()
    {
        return $this->belongsTo('App\Models\Master\Outlet', 'sale_outlet_id', 'out_id');
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Master\Customer', 'sale_customer_id', 'cus_id');
    }

    public function tax()
    {
        return $this->belongsTo('App\Models\Master\Tax', 'sale_tax_id', 'tax_id');
    }

    public function items()
    {
        return $this->hasMany('App\Models\Transaction\SaleDetail', 'saledet_sale_id', 'sale_id');
    }

    public function employee()
    {
        return $this->hasMany('App\Models\Master\Employee', 'emp_id', 'sale_user_id');
    }
}
