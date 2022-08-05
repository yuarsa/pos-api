<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMstTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_taxes', function (Blueprint $table) {
            $table->string('tax_id', 191)->primary();
            $table->unsignedBigInteger('tax_comp_id')->index();
            $table->string('tax_name', 45);
            $table->decimal('tax_rate', 5, 2); // Dalam bentuk persen
            $table->boolean('tax_enabled');
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
        Schema::dropIfExists('mst_taxes');
    }
}
