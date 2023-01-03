<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableBooking extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookings', function(Blueprint $table) {
            $table->string('attachment')->nullable()->change();
            $table->string('name');
            $table->string('nip');
            $table->string('phone');
            $table->text('description');
            $table->integer('participant');
            $table->integer('division_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bookings', function(Blueprint $table) {
            $table->string('attachment')->change();
            $table->dropColumn([
                'name',
                'nip',
                'phone',
                'description',
                'participant',
                'division_id'
            ]);
        });
    }
}
