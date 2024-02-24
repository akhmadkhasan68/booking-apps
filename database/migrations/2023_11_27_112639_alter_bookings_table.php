<?php

use App\Enums\DivisionTypeEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['division_type']);
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
            $table->enum('division_type', [
                DivisionTypeEnum::INTERNAL,
                DivisionTypeEnum::EXTERNAL,
                DivisionTypeEnum::GABUNGAN,
            ]);
        });
    }
}
