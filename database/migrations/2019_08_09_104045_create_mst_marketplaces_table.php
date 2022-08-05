<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMstMarketplacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_marketplaces', function (Blueprint $table) {
            $table->bigIncrements('market_id');
            $table->unsignedBigInteger('market_user_id')->index()->nullable();
            $table->unsignedBigInteger('market_outlet_id')->index()->nullable();
            $table->string('market_access_token', 191)->nullable();
            $table->string('market_store_id', 191)->nullable();
            $table->string('market_store_name', 191)->nullable();
            $table->string('market_type', 191)->nullable();
            $table->boolean('market_sync')->default(false);
            $table->boolean('market_enabled')->default(false);
            $table->timestamp('market_last_sync')->nullable();
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
        Schema::dropIfExists('mst_marketplaces');
    }
}
