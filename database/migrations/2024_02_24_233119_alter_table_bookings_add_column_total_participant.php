<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableBookingsAddColumnTotalParticipant extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->integer('participant_internal')->after('room_id')->default(0);
            $table->integer('participant_external')->after('participant_internal')->default(0);
            $table->integer('participant')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('participant_internal');
            $table->dropColumn('participant_external');
            $table->integer('participant')->change();
        });
    }
}
