<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateComputedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('computeds', function (Blueprint $table) {
            $table->id();
            $table->string('ctotal_price');
            $table->string('deposited_price');
            $table->string('r1c_id')->nullable();
            $table->string('r2c_id')->nullable();
            $table->string('r3c_id')->nullable();
            $table->dateTime('deposited_on')->nullable();
            $table->dateTime('fullfilled_on')->nullable();
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
        Schema::dropIfExists('computeds');
    }
}
