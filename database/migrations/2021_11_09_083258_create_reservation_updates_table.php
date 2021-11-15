<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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
            $table->date('arrival_date')->nullable();
            $table->date('departure_date')->nullable();
            $table->string('updated_room1')->nullable();
            $table->string('updated_room2')->nullable();
            $table->string('updated_room3')->nullable();
            $table->string('updated_rate1')->nullable();
            $table->string('updated_rate2')->nullable();
            $table->string('updated_rate3')->nullable();
            $table->string('fname_update')->nullable();
            $table->string('lname_update')->nullable();
            $table->string('address_update')->nullable();
            $table->string('city_update')->nullable();
            $table->string('mobile_num_update')->nullable();
            $table->string('email')->nullable();
            $table->string('updated_total')->nullable();
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
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
