<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRateDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rate_descriptions', function (Blueprint $table) {
            $table->string('rate_name')->primary();
            $table->string('rate_offer1');
            $table->string('rate_offer2');
            $table->string('rate_offer3');
            $table->float('base_discount');
            $table->float('service_rate');
            $table->float('city_tax');
            $table->float('vat');
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
        Schema::dropIfExists('rate_descriptions');
    }
}
