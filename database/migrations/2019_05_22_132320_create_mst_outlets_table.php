<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMstOutletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_outlets', function (Blueprint $table) {
            $table->bigIncrements('out_id');
            $table->string('out_uuid', 191);
            $table->unsignedBigInteger('out_comp_id')->index();
            $table->string('out_name', 191);
            $table->string('out_email', 191);
            $table->string('out_phone', 25);
            $table->text('out_address')->nullable();
            $table->char('out_prov_code', 2)->nullable();
            $table->char('out_reg_code', 4)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mst_outlets');
    }
}
