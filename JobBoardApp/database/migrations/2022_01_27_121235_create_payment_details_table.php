<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('payment_id');
            // $table->index('payment_intent');
            // $table->index('payment_method');
            $table->json('paypal_ids')->nullable();
            $table->json('paypal_data')->nullable();
            
            $table->json('stripe_ids')->nullable();
            $table->json('stripe_data')->nullable();
            
            $table->timestamps();
            $table->foreign('payment_id')->references('id')->on('payments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_details');
    }
}
