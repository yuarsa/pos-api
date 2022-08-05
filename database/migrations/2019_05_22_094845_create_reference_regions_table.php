<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferenceRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_provinces', function (Blueprint $table) {
            $table->char('prov_code', 2)->primary();
            $table->string('prov_name', 191);
            $table->timestamps();
        });

        Schema::create('ref_regencies', function (Blueprint $table) {
            $table->char('reg_code', 4)->primary();
            $table->char('reg_prov_code', 2);
            $table->string('reg_name', 191);
            $table->timestamps();
        });

        Schema::create('ref_districts', function (Blueprint $table) {
            $table->char('dist_code', 7)->primary();
            $table->char('dist_reg_code', 4);
            $table->string('dist_name', 191);
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
        Schema::dropIfExists('ref_provinces');
        Schema::dropIfExists('ref_regencies');
        Schema::dropIfExists('ref_districts');
    }
}
