<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMstEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_employees', function (Blueprint $table) {
            $table->string('emp_id', 191)->primary();
            $table->unsignedBigInteger('emp_out_id')->index();
            $table->char('emp_type', 1); // c:cashier, m:manager
            $table->string('emp_name', 45);
            $table->string('emp_email', 191)->unique();
            $table->string('emp_phone', 25);
            $table->char('emp_pin', 4);
            $table->boolean('emp_enabled')->default(true);
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
        Schema::dropIfExists('mst_employees');
    }
}
