<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertResidentIdColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tax_data', function (Blueprint $table) {
            $table->integer('resident_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('tax_data', 'resident_id'))

        {

            Schema::table('tax_data', function (Blueprint $table)

            {

                $table->dropColumn('resident_id');

            });

        }
    }
}
