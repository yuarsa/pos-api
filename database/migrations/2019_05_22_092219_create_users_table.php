<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid', 191);
            $table->string('username', 45)->nullable();
            $table->string('email', 191)->unique();
            $table->string('name', 45);
            $table->string('password', 191);
            $table->rememberToken();
            $table->string('activation_token', 191)->nullable();
            $table->boolean('enabled')->default(false);
            $table->char('type', 1)->nullable(); // c:company, o:outlet, s: sistem
            $table->unsignedBigInteger('value_id')->default(0);
            $table->timestamp('login_at')->nullable();
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
        Schema::dropIfExists('users');
    }
}
