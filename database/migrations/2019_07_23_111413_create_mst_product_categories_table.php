<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMstProductCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_product_categories', function (Blueprint $table) {
            $table->increments('prodcat_id');
            $table->string('prodcat_uuid', 191)->unique();
            $table->unsignedBigInteger('prodcat_company_id')->index()->default(0);
            $table->unsignedBigInteger('prodcat_outlet_id')->index()->default(0);
            $table->string('prodcat_code', 45)->nullable();
            $table->string('prodcat_name', 45);
            $table->string('prodcat_slug', 191)->nullable();
            $table->string('prodcat_description', 200)->nullable();
            $table->unsignedBigInteger('prodcat_parent_id')->default(0)->nullable();
            $table->string('prodcat_label', 45)->nullable();
            $table->string('prodcat_image', 191)->nullable();
            $table->boolean('prodcat_featured')->default(false);
            $table->boolean('prodcat_enabled')->default(true);
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
        Schema::dropIfExists('mst_product_categories');
    }
}
