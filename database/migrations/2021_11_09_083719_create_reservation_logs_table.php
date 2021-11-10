<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_logs', function (Blueprint $table) {

            $table->string('guest_code');
            $table->string('payment_information');
            $table->string('rr_code');
            $table->date('arrival_date');
            $table->date('departure_date');
            $table->string('promotion_code');
            $table->string('log_status');
            $table->dateTime('booked_at');
            $table->dateTime('end_at');
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
        Schema::dropIfExists('reservation_logs');
    }
}
