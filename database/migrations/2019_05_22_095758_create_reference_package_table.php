<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferencePackageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_license_packages', function (Blueprint $table) {
            $table->string('lp_id', 191)->primary();
            $table->string('lp_name', 45);
            $table->unsignedTinyInteger('lp_month')->default(0);
            $table->decimal('lp_price_offered', 20, 2)->default(0.00);
            $table->boolean('lp_enabled')->default(true);
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
        Schema::dropIfExists('ref_license_packages');
    }
}
