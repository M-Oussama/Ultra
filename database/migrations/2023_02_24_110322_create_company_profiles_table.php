<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_profiles', function (Blueprint $table) {
            $table->id();
               $table->string('name');
                $table->string('surname')->nullable();
                $table->string('address')->nullable();
                $table->string('email')->nullable();
                $table->string('capital')->nullable();
                $table->string('phone')->nullable();
                $table->string('NRC')->nullable();
                $table->string('NIF')->nullable();
                $table->string('NART')->nullable();
                $table->string('NIS')->nullable();
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
        Schema::dropIfExists('company_profiles');
    }
}
