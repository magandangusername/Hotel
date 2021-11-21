<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCancellationRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cancellation_requests', function (Blueprint $table) {
            $table->id();
            $table->string('confirmation_number');
            $table->timestamp('request_on')->default(\DB::raw('CURRENT_TIMESTAMP'));;
            $table->string('reason')->nullable();
            $table->string('approval_status')->nullable();
            $table->dateTime('approved_denied_on')->nullable();
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
        Schema::dropIfExists('cancellation_requests');
    }
}
