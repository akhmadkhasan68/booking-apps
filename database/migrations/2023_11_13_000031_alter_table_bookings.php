<?php

use App\Enums\DivisionTypeEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableBookings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->integer('room_id')->nullable()->change();
            $table->enum('division_type', [
                DivisionTypeEnum::INTERNAL->value,
                DivisionTypeEnum::EXTERNAL->value,
                DivisionTypeEnum::GABUNGAN->value,
            ]);
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
            $table->integer('room_id')->change();
            $table->dropColumn('division_type');
        });
    }
}
