<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservedRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserved_rooms', function (Blueprint $table) {
            $table->string('rr_code')->primary();
            $table->string('r1');
            $table->string('r2');
            $table->string('r3');
            $table->string('rate1');
            $table->string('rate2');
            $table->string('rate3');
            $table->string('r1h');
            $table->string('r2h');
            $table->string('r3h');
            $table->integer('head_count_id1');
            $table->integer('head_count_id2')->nullable();
            $table->integer('head_count_id3')->nullable();
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
        Schema::dropIfExists('reserved_rooms');
    }
}
