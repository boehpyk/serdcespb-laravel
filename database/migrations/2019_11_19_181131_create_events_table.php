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
            $table->date('date_begin');
            $table->date('date_end')->nullable();
            $table->string('city', 256);
            $table->string('info', 512)->nullable();
            $table->string('club_name', 512)->nullable();
            $table->string('club_url', 512)->nullable();
            $table->string('meeting_url', 256)->nullable();
            $table->string('tickets_url', 256)->nullable();
            $table->string('image', 256)->nullable();
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
