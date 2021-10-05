<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonthlyProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthly_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('monthly_profits_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('product_monthly_profit')->nullable();
            $table->unsignedBigInteger('quantity')->nullable();
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
        Schema::dropIfExists('monthly_products');
    }
}
