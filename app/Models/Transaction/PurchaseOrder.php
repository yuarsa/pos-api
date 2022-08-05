<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid as GeneratorUuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

class PurchaseOrder extends Model
{
    protected $table = 'trx_purchase_order';
    protected $primaryKey = 'po_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'po_uuid',
        'po_code',
        'po_company_id',
        'po_outlet_id',
        'po_supplier_id',
        'po_supplier_reference',
        'po_date',
        'po_date_due',
        'po_terms_id',
        'po_note',
        'po_memo',
        'po_attachment',
        'po_status',
        'po_amount',
        'po_discount',
        'po_tax',
        'po_total',
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            try {
                $model->po_uuid = GeneratorUuid::uuid4()->toString();
            } catch (UnsatisfiedDependencyException $ude) {
                abort(500, $ude->getMessage());
            }
        });
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Master\Company', 'po_company_id', 'comp_id');
    }
    
    public function outlet()
    {
        return $this->belongsTo('App\Models\Master\Outlet', 'po_outlet_id', 'out_id');
    }

    public function supplier()
    {
        return $this->belongsTo('App\Models\Master\Supplier', 'po_supplier_id', 'sup_id');
    }

    public function paymentTerms()
    {
        return $this->belongsTo('App\Models\Reference\PaymentTerm', 'po_terms_id', 'payterm_id');
    }

    public function items()
    {
        return $this->hasMany('App\Models\Transaction\PurchaseOrderDetail', 'pod_po_id', 'po_id');
    }
}
