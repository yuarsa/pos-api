<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferenceCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_currencies', function (Blueprint $table) {
            $table->string('curr_id', 191)->primary();
            $table->char('curr_code', 3)->unique();
            $table->string('curr_name', 45);
            $table->double('curr_rate', 15, 8);
            $table->string('curr_symbol', 25);
            $table->string('curr_precision', 10);
            $table->char('curr_decimal', 1);
            $table->char('curr_separator', 1);
            $table->boolean('curr_enabled')->default(true);
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
        Schema::dropIfExists('ref_currencies');
    }
}
