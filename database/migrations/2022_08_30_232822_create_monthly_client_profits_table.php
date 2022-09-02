<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonthlyClientProfitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthly_client_profits', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('month')->nullable();
            $table->unsignedInteger('product_id')->nullable();
            $table->unsignedInteger('client_id')->nullable();
            $table->double('quantity')->nullable();
            $table->double('profit')->nullable();
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
        Schema::dropIfExists('monthly_client_profits');
    }
}
