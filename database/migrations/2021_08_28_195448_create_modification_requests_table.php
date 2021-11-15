<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateModificationRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modification_requests', function (Blueprint $table) {
            $table->string('midc')->primary();
            $table->string('confirmation_number');
            $table->string('update_code')->nullable();
            $table->dateTime('request_on')->nullable();
            $table->tinyInteger('approval_status')->nullable();
            $table->dateTime('approved_at')->nullable();
            $table->dateTime('denied_at')->nullable();
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
        Schema::dropIfExists('modification_requests');
    }
}
