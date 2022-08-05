<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMstCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_customers', function (Blueprint $table) {
            $table->bigIncrements('cus_id');
            $table->string('cus_uuid', 191);
            $table->unsignedBigInteger('cus_comp_id')->index();
            $table->string('cus_code', 45);
            $table->string('cus_name', 45);
            $table->date('cus_birthday')->nullable();
            $table->string('cus_email', 191)->nullable();
            $table->string('cus_phone', 25);
            $table->text('cus_address')->nullable();
            $table->char('cus_prov_code', 2)->nullable();
            $table->char('cus_reg_code', 4)->nullable();
            $table->char('cus_postal_code', 5)->default('00000');
            $table->boolean('sup_enabled')->default(true);
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
        Schema::dropIfExists('mst_customers');
    }
}
