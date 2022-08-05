<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrxReceivedOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trx_received_order', function (Blueprint $table) {
            $table->bigIncrements('rcv_id');
            $table->unsignedBigInteger('rcv_po_id')->index();
            $table->string('rcv_code', 191)->unique();
            $table->date('rcv_date');
            $table->string('rcv_shipping_number', 191)->nullable();
            $table->string('rcv_shipping_name', 191)->nullable();
            $table->text('rcv_description')->nullable();
            $table->unsignedTinyInteger('rcv_status')->default(1);
            $table->timestamps();
        });

        Schema::create('trx_received_order_detail', function (Blueprint $table) {
            $table->bigIncrements('rcvd_id');
            $table->unsignedBigInteger('rcvd_rcv_id')->index();
            $table->unsignedBigInteger('rcvd_product_id')->index();
            $table->unsignedInteger('rcvd_qty')->default(0);
            $table->unsignedTinyInteger('rcvd_status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trx_received_order');
        Schema::dropIfExists('trx_received_order_detail');
    }
}
