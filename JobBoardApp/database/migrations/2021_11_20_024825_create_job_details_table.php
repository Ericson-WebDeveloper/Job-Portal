<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_details', function (Blueprint $table) {
            $table->id();
            // Additional Information
            $table->unsignedBigInteger('job_id');
            $table->string('salary');
            // $table->string('contract'); //freelance regular full time
            $table->json('job_details')->nullable();
            $table->json('additional_details')->nullable();

            $table->string('banner')->nullable(true); // add jan 9 2023
            $table->timestamps();

            $table->foreign('job_id')->references('id')->on('jobs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_details');
    }
}
