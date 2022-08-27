<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventFeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_feeds', function (Blueprint $table) {
            $table->id();
            $table->integer('event_id')->default(-1);
            $table->integer('user_id')->default(-1);
            $table->string('path')->nullable();
            $table->string('description')->nullable();
            $table->string('tag_people')->nullable();
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
        Schema::dropIfExists('event_feeds');
    }
}
