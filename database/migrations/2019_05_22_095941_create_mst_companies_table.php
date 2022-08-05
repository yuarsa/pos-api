<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMstCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_companies', function (Blueprint $table) {
            $table->bigIncrements('comp_id');
            $table->string('comp_uuid', 191);
            $table->unsignedTinyInteger('comp_ub_id')->index();
            $table->string('comp_name', 191);
            $table->string('comp_address', 191)->nullable();
            $table->char('comp_prov_code', 2)->nullable();
            $table->char('comp_reg_code', 4)->nullable();
            $table->char('comp_dist_code', 7)->nullable();
            $table->string('comp_postal_code', 5)->nullable();
            $table->string('comp_email', 191)->unique();
            $table->string('comp_website', 191)->nullable();
            $table->string('comp_phone', 20);
            $table->string('comp_phone_alt', 20)->nullable();
            $table->string('comp_fax', 20)->nullable();
            $table->string('comp_curr_id', 191)->nullable();
            $table->string('comp_logo', 191)->nullable();
            $table->boolean('comp_enabled')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('mst_companies_licenses', function (Blueprint $table) {
            $table->unsignedBigInteger('complp_comp_id')->index()->nullable();
            $table->string('complp_lp_id', 191)->index();
            $table->date('complp_date');
            $table->date('complp_date_expired');
            $table->decimal('complp_price', 20, 2)->default(0.00);
            $table->unsignedTinyInteger('complp_max_branch')->default(0);
            $table->boolean('complp_enabled')->default(false);
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
        Schema::dropIfExists('mst_companies');
        Schema::dropIfExists('mst_companies_licenses');
    }
}
