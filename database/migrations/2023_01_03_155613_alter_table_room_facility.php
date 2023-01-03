<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableRoomFacility extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('facilities', function (Blueprint $table) {
            $table->dropColumn(['quantity']);
        });

        Schema::table('room_facilities', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('facilities', function (Blueprint $table) {
            $table->addColumn('integer', 'quantity');
        });
        
        Schema::table('room_facilities', function (Blueprint $table) {
            $table->dropColumn(['quantity']);
        });
    }
}
