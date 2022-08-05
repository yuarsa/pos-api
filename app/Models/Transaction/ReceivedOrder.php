<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Model;

class ReceivedOrder extends Model
{
    protected $table = 'trx_received_order';
    protected $primaryKey = 'rcv_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rcv_po_id',
        'rcv_code',
        'rcv_date',
        'rcv_shipping_number',
        'rcv_shipping_name',
        'rcv_description',
        'rcv_status',
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    public function items()
    {
        return $this->hasMany('App\Models\Transaction\ReceivedOrderDetail', 'rcvd_rcv_id', 'rcv_id');
    }

    public function purchase()
    {
        return $this->belongsTo('App\Models\Transaction\PurchaseOrder', 'rcv_po_id', 'po_id');
    }
}
