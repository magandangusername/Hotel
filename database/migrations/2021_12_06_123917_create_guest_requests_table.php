<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateGuestRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guest_requests', function (Blueprint $table) {
            $table->id('rq_id');
            $table->string('rq1')->nullable();
            $table->string('rq2')->nullable();
            $table->string('rq3')->nullable();
            $table->string('rq4')->nullable();
            $table->string('rq5')->nullable();
            $table->string('rq6')->nullable();
            $table->string('rq7')->nullable();
            $table->string('rq8')->nullable();
            $table->string('rq9')->nullable();
            $table->string('rq10')->nullable();
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
        Schema::dropIfExists('guest_requests');
    }
}
