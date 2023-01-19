<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubSpecializationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_specializations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('specialization_id');
            $table->text('name');
            $table->timestamps();

            $table->foreign('specialization_id')->references('id')->on('specializations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_specializations');
    }
}
