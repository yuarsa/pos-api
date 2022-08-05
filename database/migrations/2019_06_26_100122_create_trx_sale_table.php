<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrxSaleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trx_sale', function (Blueprint $table) {
            $table->bigIncrements('sale_id');
            $table->string('sale_uuid', 191);
            $table->unsignedTinyInteger('sale_type')->default(1)->comment('1: Sistem, 2: POS');
            $table->unsignedBigInteger('sale_outlet_id')->index();
            $table->string('sale_code', 191);
            $table->timestamp('sale_date');
            $table->string('sale_cashier', 191);
            $table->unsignedBigInteger('sale_customer_id')->index();
            $table->double('sale_total', 20, 2)->default(0.00);
            $table->double('sale_discount', 20, 2)->default(0.00);
            $table->string('sale_tax_id', 191)->index()->nullable();
            $table->double('sale_tax', 20, 2)->default(0.00);
            $table->double('sale_grand_total', 20, 2)->default(0.00);
            $table->unsignedTinyInteger('sale_payment_type')->default(1); // 1: cash, 2: Debit, 3: Kredit
            $table->double('sale_payment_amount', 20, 2)->default(0.00);
            $table->double('sale_payment_balance', 20, 2)->default(0.00);
            $table->unsignedBigInteger('sale_user_id')->index();
            $table->timestamps();
        });

        Schema::create('trx_sale_detail', function (Blueprint $table) {
            $table->bigIncrements('saledet_id');
            $table->string('saledet_uuid', 191);
            $table->unsignedBigInteger('saledet_sale_id')->index();
            $table->unsignedBigInteger('saledet_product_id')->index();
            $table->unsignedInteger('saledet_qty')->default(0);
            $table->double('saledet_price', 20,2)->default(0.00);
            $table->double('saledet_total', 20,2)->default(0.00);
            $table->double('saledet_discount_percent', 5,2)->default(0.00);
            $table->double('saledet_discount', 20,2)->default(0.00);
            $table->string('saledet_tax_id', 191)->index()->nullable();
            $table->double('saledet_tax', 20, 2)->default(0.00);
            $table->double('saledet_grand_total', 20,2)->default(0.00);
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
        Schema::dropIfExists('trx_sale');
        Schema::dropIfExists('trx_sale_detail');
    }
}
