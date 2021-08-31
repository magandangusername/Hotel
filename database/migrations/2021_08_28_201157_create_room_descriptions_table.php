<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_descriptions', function (Blueprint $table) {
            $table->string('room_name')->primary();
            $table->string('image_name')->collation('utf8_unicode_ci');
            $table->string('room_short_description');
            $table->string('room_long_description');
            $table->string('amenities_number');
            $table->string('room_size');
            $table->float('base_price');
            $table->string('bed_type');
            $table->integer('album_id');
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
        Schema::dropIfExists('room_descriptions');
    }
}
