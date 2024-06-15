<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type', 24);
            $table->string('name', 512);
            $table->bigInteger('added_by');
            $table->string('url', 2048)->nullable();
            $table->string('path', 512)->nullable();
            $table->string('description', 256)->nullable();
            $table->bigInteger('parent')->nullable();
            $table->string('image_size', 64)->nullable();
            $table->integer('height')->length(6)->nullable();
            $table->integer('width')->length(6)->nullable();
            $table->string('kilobyte')->nullable();
            $table->boolean('deleted')->default(false);
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
        Schema::dropIfExists('media');
    }
}
