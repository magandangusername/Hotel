<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateSuiteDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suite_descriptions', function (Blueprint $table) {
            $table->string('suite_name')->primary();
            $table->string('image_name')->collation('utf8_unicode_ci');
            $table->string('suite_short_description');
            $table->string('suite_long_description');
            $table->string('amenities_number');
            $table->string('suite_size');
            $table->string('base_price');
            $table->string('bed_type');
            $table->integer('album_id');
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
        Schema::dropIfExists('suite_descriptions');
    }
}
