<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotion_descriptions', function (Blueprint $table) {
            $table->string('promotion_code')->primary();
            $table->string('promotion_name');
            $table->string('promotion_short_description');
            $table->string('promotion_long_description');
            $table->string('terms_conditions1');
            $table->string('terms_conditions2');
            $table->string('terms_conditions3');
            $table->dateTime('promotion_start');
            $table->dateTime('promotion_end');
            $table->float('overall_cut');
            $table->string('image_name')->collation('utf8_unicode_ci');
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
        Schema::dropIfExists('promotion_descriptions');
    }
}
