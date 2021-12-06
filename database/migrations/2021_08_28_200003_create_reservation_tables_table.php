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
            $table->integer('user_id')->nullable();
            $table->string('guest_code')->nullable();
            $table->string('rr_code');
            $table->string('promotion_code');
            $table->dateTime('Booked_at');
            $table->integer('computed_price_id');
            $table->string('payment_status')->default('Deposited');
            $table->string('reservation_status')->default('Upcoming');
            $table->integer('request_id')->nullable();
            $table->integer('transfer_id')->nullable();
            $table->string('charge_id')->nullable();
            $table->dateTime('modified_on')->nullable();
            $table->dateTime('cancelled_on')->nullable();

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
