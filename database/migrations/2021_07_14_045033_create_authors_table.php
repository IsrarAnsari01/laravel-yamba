<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;

class CreateAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("email");
            $table->string("password");
            $table->json('videoCat_id')->default(new Expression('(JSON_ARRAY())'));
            // $table->json('video_uploads_id')->default(new Expression('(JSON_ARRAY())'));
            // $table->foreign("video_uploads_id")->references("id")->on("video_uploads")->onDelete('cascade');
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
        Schema::dropIfExists('authors');
    }
}
