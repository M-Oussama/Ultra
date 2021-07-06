<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();

            //Algeria
            $table->string('address')->nullable();
            $table->unsignedInteger('wilaya_id')->nullable();
            $table->unsignedInteger('daira_id')->nullable();
            $table->unsignedInteger('baladia_id')->nullable();

            //Global
            $table->unsignedInteger('country_id')->nullable();
            $table->string('zip')->nullable();

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
        Schema::dropIfExists('addresses');
    }
}
