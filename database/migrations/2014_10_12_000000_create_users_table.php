<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('user_id');
            $table->string('avatar')->nullable();
            $table->string('name');
            $table->string('last_name');
            $table->string('phone')->nullable();
            // user_ email instead email for work on platform and our admin panel
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->dateTime('user_last_seen')->nullable();
            $table->string('user_ip')->nullable();
            $table->integer('user_profile_entity')->unsigned()->nullable();
            $table->enum('user_type', ['ROOT', 'ADMIN', 'AUTHOR', 'CUSTOMER'])->nullable();
            $table->boolean('active')->default(1);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
