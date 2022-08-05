<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Model;

class ReceivedOrderDetail extends Model
{
    protected $table = 'trx_received_order_detail';
    protected $primaryKey = 'rcvd_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rcvd_rcv_id',
        'rcvd_product_id',
        'rcvd_qty',
        'rcvd_status',
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    public function received()
    {
        return $this->belongsTo('App\Models\Transaction\ReceivedOrder', 'rcvd_rcv_id', 'rcv_id');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Master\Product', 'rcvd_product_id', 'prod_id');
    }
}
