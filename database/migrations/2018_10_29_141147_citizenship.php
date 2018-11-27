<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Citizenship extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('citizenship', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name')->unique();
        $table->string('email')->unique()->nullable();
        $table->string('nric')->unique();
        $table->string('race');
        $table->string('gender');
        $table->string('address', 500)->nullable();
        $table->timestamp('date_of_birth');
        $table->string('driving_license')->nullable();
        $table->timestamp('driver_expiry_date')->nullable();
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
        Schema::dropIfExists('citizenship');
    }
}
