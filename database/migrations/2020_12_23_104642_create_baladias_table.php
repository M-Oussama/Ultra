<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaladiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baladias', function (Blueprint $table) {
            $table->id();
            $table->string('BALADIA')->unique();
            $table->string('name_ar')->nullable();
            $table->string('name_fr')->nullable();
            $table->unsignedBigInteger('daira_id')->nullable();
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
        Schema::dropIfExists('baladias');
    }
}
