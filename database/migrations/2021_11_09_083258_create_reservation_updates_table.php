<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_updates', function (Blueprint $table) {
            $table->id();
            $table->date('arrival_date');
            $table->date('departure_date');
            $table->string('updated_room1');
            $table->string('updated_room2');
            $table->string('updated_room3');
            $table->string('updated_rate1');
            $table->string('updated_rate2');
            $table->string('updated_rate3');
            $table->string('fname_update');
            $table->string('lname_update');
            $table->string('address_update');
            $table->string('city_update');
            $table->string('mobile_num_update');
            $table->string('email');
            $table->string('updated_total');
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
        Schema::dropIfExists('reservation_updates');
    }
}
