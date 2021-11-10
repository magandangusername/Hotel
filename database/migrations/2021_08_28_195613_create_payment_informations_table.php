<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_informations', function (Blueprint $table) {
            $table->string('payment_code')->primary();
            $table->string('payment_type');
            $table->string('card_number');
            $table->string('card_holder_name');
            $table->string('expiration_month');
            $table->string('expiration_year');
            $table->string('cvc');
            $table->string('charge_id')->nullable();
            $table->string('customer_id')->nullable();
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
        Schema::dropIfExists('payment_informations');
    }
}
