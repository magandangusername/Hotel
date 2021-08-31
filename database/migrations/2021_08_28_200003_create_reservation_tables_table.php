<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_tables', function (Blueprint $table) {
            $table->string('confirmation_number')->primary();
            $table->date('arrival_date');
            $table->date('departure_date');
            $table->string('guest_code');
            $table->string('rr_code');
            $table->string('promotion_code');
            $table->dateTime('modified_on');
            $table->dateTime('cancelled_on');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservation_tables');
    }
}
