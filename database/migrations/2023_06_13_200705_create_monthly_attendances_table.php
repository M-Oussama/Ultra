<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonthlyAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthly_attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('month')->nullable();
            $table->unsignedInteger('year')->nullable();
            $table->double('payroll')->default(0);
            $table->double('cnas_contributions')->default(0);
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
        Schema::dropIfExists('monthly_attendances');
    }
}
