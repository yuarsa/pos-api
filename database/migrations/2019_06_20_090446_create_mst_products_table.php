<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMstProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_product_merks', function (Blueprint $table) {
            $table->increments('prodmerk_id');
            $table->string('prodmerk_uuid')->unique();
            $table->unsignedBigInteger('prodmerk_company_id')->index()->default(0);
            $table->unsignedBigInteger('prodmerk_outlet_id')->index()->default(0);
            $table->string('prodmerk_name', 50);
            $table->string('prodmerk_description', 200)->nullable();
            $table->timestamps();
        });

        Schema::create('mst_product_categories', function (Blueprint $table) {
            $table->increments('prodcat_id');
            $table->string('prodcat_uuid')->unique();
            $table->unsignedBigInteger('prodcat_company_id')->index()->default(0);
            $table->unsignedBigInteger('prodcat_outlet_id')->index()->default(0);
            $table->string('prodcat_code', 45)->nullable();
            $table->string('prodcat_name', 45);
            $table->string('prodcat_description', 200)->nullable();
            $table->string('prodcat_label', 45)->nullable();
            $table->timestamps();
        });

        Schema::create('mst_products', function (Blueprint $table) {
            $table->bigIncrements('prod_id');
            $table->string('prod_uuid')->unique();
            $table->unsignedBigInteger('prod_company_id')->index()->default(0);
            $table->unsignedBigInteger('prod_outlet_id')->index()->default(0);
            $table->unsignedInteger('prod_category_id')->index()->default(0);
            $table->unsignedInteger('prod_merk_id')->index()->default(0);
            $table->string('prod_name', 191);
            $table->string('prod_sku', 191)->nullable();
            $table->string('prod_unit', 10)->nullable();
            $table->text('prod_description')->nullable();
            $table->double('prod_price_sell', 20,2)->default(0.00);
            $table->double('prod_price_purchase', 20,2)->default(0.00);
            $table->string('prod_serial', 191)->nullable();
            $table->string('prod_barcode', 191)->nullable();
            $table->integer('prod_stock')->default(0);
            $table->string('prod_image', 191)->nullable();
            $table->boolean('prod_is_sell')->default(true);
            $table->boolean('prod_enabled')->default(true);
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
        Schema::dropIfExists('mst_product_merks');
        Schema::dropIfExists('mst_product_categories');
        Schema::dropIfExists('mst_products');
    }
}
