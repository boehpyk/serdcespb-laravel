<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 512);
            $table->date('date_begin');
            $table->date('time_begin')->nullable();
            $table->string('info', 512)->nullable();
            $table->string('meeting_url', 256)->nullable();
            $table->string('tickets_url', 256)->nullable();
            $table->string('artist_url', 256)->nullable();
            $table->string('image', 256)->nullable();
            $table->mediumText('music_url')->nullable();
            $table->longText('description')->nullable();
            $table->enum('is_publish', ['yes', 'no'])->default('yes');
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
        Schema::dropIfExists('events');
    }
}
