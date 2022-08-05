<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrxPurchaseOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trx_purchase_order', function (Blueprint $table) {
            $table->bigIncrements('po_id');
            $table->string('po_uuid', 191)->unique();
            $table->string('po_code', 191);
            $table->unsignedBigInteger('po_company_id')->index();
            $table->unsignedBigInteger('po_outlet_id')->index();
            $table->unsignedBigInteger('po_supplier_id')->index();
            $table->string('po_supplier_reference', 191)->nullable();
            $table->date('po_date');
            $table->date('po_date_due');
            $table->string('po_terms_id', 191)->index();
            $table->text('po_note')->nullable();
            $table->text('po_memo')->nullable();
            $table->string('po_attachment', 191)->nullable();
            $table->unsignedTinyInteger('po_status')->default(1);
            $table->double('po_amount', 20, 2)->default(0.00);
            $table->double('po_discount', 20, 2)->default(0.00);
            $table->double('po_tax', 20, 2)->default(0.00);
            $table->double('po_total', 20, 2)->default(0.00);
            $table->timestamps();
        });

        Schema::create('trx_purchase_order_detail', function (Blueprint $table)
        {
            $table->bigIncrements('pod_id');
            $table->string('pod_uuid', 191)->unique();
            $table->unsignedBigInteger('pod_po_id')->index();
            $table->unsignedBigInteger('pod_product_id')->index();
            $table->string('pod_description', 200)->nullable();
            $table->unsignedInteger('pod_qty')->default(0);
            $table->double('pod_price', 20, 2)->default(0.00);
            $table->double('pod_tax', 20, 2)->default(0.00);
            $table->double('pod_total', 20, 2)->default(0.00);
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
        Schema::dropIfExists('trx_purchase_order');
        Schema::dropIfExists('trx_purchase_order_detail');
    }
}
