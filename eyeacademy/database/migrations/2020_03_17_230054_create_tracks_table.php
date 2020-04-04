<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTracksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tracks', function (Blueprint $table) {
            $table->id();
            $table->time('out_time')->nullable();
            $table->integer('feedback')->nullable();
            $table->unsignedBigInteger('visit_id');
            $table->unsignedBigInteger('station_id');
            $table->timestamps();

            $table->foreign('visit_id')
                ->references('id')->on('visits')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('station_id')
                ->references('id')->on('stations')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**v
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tracks');
    }
}
