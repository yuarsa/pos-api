<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MstProductWholesaleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_product_wholesaler', function (Blueprint $table) {
            $table->increments('prodwho_id');
            $table->unsignedBigInteger('prodwho_product_id')->index()->nullable();
            $table->decimal('prodwho_qty_min', 8, 2)->nullable();
            $table->decimal('prodwho_qty_max', 8, 2)->nullable();
            $table->double('prodwho_price', 8, 2)->default(0.00)->nullable();
            $table->unsignedTinyInteger('prodwho_type')->nullable();
            $table->boolean('prodwho_enabled')->default(true);
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
        Schema::dropIfExists('mst_product_wholesaler');
    }
}
