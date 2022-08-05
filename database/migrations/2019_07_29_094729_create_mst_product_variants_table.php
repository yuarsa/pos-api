<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMstProductVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_variants', function (Blueprint $table) {
            $table->bigIncrements('vars_id');
            $table->string('vars_name', 45);
            $table->timestamps();
        });

        Schema::create('mst_variant_values', function (Blueprint $table) {
            $table->bigIncrements('val_id');
            $table->unsignedBigInteger('val_variant_id');
            $table->string('val_value', 45);
            $table->unsignedBigInteger('val_variant_id_2');
            $table->string('val_value_2', 45);
            $table->timestamps();
        });

        Schema::create('mst_product_variants', function (Blueprint $table) {
            $table->bigIncrements('prodvar_id');
            $table->unsignedBigInteger('prodvar_product_id');
            $table->unsignedBigInteger('prodvar_value_id');
            $table->double('prodvar_price', 20, 2)->default(0.00);
            $table->unsignedInteger('prodvar_stock')->default(0);
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
        Schema::dropIfExists('mst_variants');
        Schema::dropIfExists('mst_variant_values');
        Schema::dropIfExists('mst_product_variants');
    }
}
