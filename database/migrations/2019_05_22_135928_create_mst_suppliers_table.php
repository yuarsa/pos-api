<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMstSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_suppliers', function (Blueprint $table) {
            $table->bigIncrements('sup_id');
            $table->string('sup_uuid', 191);
            $table->unsignedBigInteger('sup_comp_id')->index();
            $table->string('sup_code', 45);
            $table->string('sup_name', 45);
            $table->date('sup_birthday')->nullable();
            $table->string('sup_email', 191)->nullable();
            $table->string('sup_phone', 25);
            $table->text('sup_address');
            $table->char('sup_prov_code', 2);
            $table->char('sup_reg_code', 4);
            $table->char('sup_postal_code', 5);
            $table->string('sup_contact', 45)->nullable();
            $table->string('sup_contact_phone', 25)->nullable();
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
        Schema::dropIfExists('mst_suppliers');
    }
}
