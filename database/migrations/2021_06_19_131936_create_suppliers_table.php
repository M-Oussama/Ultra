<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('NRC')->nullable();
            $table->string('NIF')->nullable();
            $table->string('NART')->nullable();
            $table->string('NIS')->nullable();
            $table->string('sold')->nullable();
            $table->unsignedBigInteger('type_id')->nullable();
            $table->string('debt')->nullable();
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
        Schema::dropIfExists('suppliers');
    }
}
