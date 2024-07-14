<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldToCommands extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('commands', function (Blueprint $table) {
            $table->boolean('timber')->default(false); // Replace 'new_column_name' with your desired column name and data type
            $table->decimal('timber_val')->default(0); // Replace 'new_column_name' with your desired column name and data type

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('commands', function (Blueprint $table) {
            $table->dropColumn('timber'); // Drop the column in the down method if you want to rollback the migration
            $table->dropColumn('timber_val'); // Drop the column in the down method if you want to rollback the migration

        });
    }
}
