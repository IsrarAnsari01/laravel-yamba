<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_uploads', function (Blueprint $table) {
            $table->id();
            $table->string("Title");
            $table->string("videoTitle");
            $table->integer('views')->default(0);
            $table->unsignedBigInteger("author_id");
            $table->foreign("author_id")->references("id")->on("authors")->onDelete('cascade');
            $table->unsignedBigInteger("videocetagory_id");
            $table->foreign("videocetagory_id")->references("id")->on("videocetagories")->onDelete('cascade');
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
        Schema::dropIfExists('video_uploads');
    }
}
