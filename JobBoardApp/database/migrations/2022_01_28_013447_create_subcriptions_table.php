<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubcriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subcriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('payment_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('company_id');
            $table->enum('status', ['subcribed', 'not-subcribed'])->default('not-subcribed');
            $table->dateTime('start', $precision = 0)->nullable();
            $table->dateTime('end', $precision = 0)->nullable();
            $table->json('datas')->nullable();
            $table->timestamps();

            $table->foreign('payment_id')->references('id')->on('payments');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('company_id')->references('id')->on('companies');

            // subcription -> one -> user_id, company_id, status, start, end, datas -> json();
            // $table->unsignedBigInteger('payment_id'); $table->foreign('payment_id')->references('id')->on('payments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subcriptions');
    }
}
