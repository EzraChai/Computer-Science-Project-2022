<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarkahPesertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('markah_pesertas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("pusingan_id");
            $table->unsignedBigInteger("peserta_id");
            $table->float("marks");
            $table->float("total_marks");
            $table->float("judge_1")->nullable();
            $table->float("judge_2")->nullable();
            $table->float("judge_3")->nullable();
            $table->float("judge_4")->nullable();
            $table->float("judge_5")->nullable();
            $table->float("judge_6")->nullable();
            $table->float("judge_7")->nullable();
            $table->float("difficulty")->nullable();
            $table->float("penalty")->nullable();
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
        Schema::dropIfExists('markah_pesertas');
    }
}
