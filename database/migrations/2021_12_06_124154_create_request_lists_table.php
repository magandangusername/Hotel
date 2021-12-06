<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateRequestListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_lists', function (Blueprint $table) {
            $table->id('rql_id');
            $table->string('rql1')->nullable();
            $table->string('rql2')->nullable();
            $table->string('rql3')->nullable();
            $table->string('rql4')->nullable();
            $table->string('rql5')->nullable();
            $table->string('rql6')->nullable();
            $table->string('rql7')->nullable();
            $table->string('rql8')->nullable();
            $table->string('rql9')->nullable();
            $table->string('rql10')->nullable();
            $table->string('request_charge')->nullable();
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
        Schema::dropIfExists('request_lists');
    }
}
