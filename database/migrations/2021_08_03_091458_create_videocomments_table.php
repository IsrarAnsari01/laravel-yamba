<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideocommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videocomments', function (Blueprint $table) {
            $table->id();
            $table->string("email");
            $table->string("body");
            $table->unsignedBigInteger("author_id");
            $table->foreign("author_id")->references("id")->on("authors")->onDelete('cascade');
            $table->unsignedBigInteger("videoupload_id");
            $table->foreign("videoupload_id")->references("id")->on("video_uploads")->onDelete('cascade');
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
        Schema::dropIfExists('videocomments');
    }
}
