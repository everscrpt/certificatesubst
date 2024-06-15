<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('post_author')->nullable();
            $table->text('post_content')->nullable();
            $table->string('post_title')->nullable();
            $table->longtext('meta_description')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('slug')->nullable();
            $table->string('post_excerpt')->nullable();
            $table->char('post_status', 64)->default('draft');
            $table->char('comment_status', 16)->default('open');
            $table->bigInteger('post_parent')->nullable();
            $table->char('post_type',32)->nullable('post');
            $table->char('post_mime_type',32)->nullable();
            $table->integer('comment_count')->default(0);
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
        Schema::dropIfExists('posts');
    }
}
