<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthorVideocetagoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('author_videocetagories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("author_id");
            $table->foreign("author_id")->references("id")->on("authors")->onDelete('cascade');
            $table->unsignedBigInteger("videocetagory_id");
            $table->foreign("videocetagory_id")->references("id")->on("videocetagories")->onDelete('cascade');
            $table->integer("subscription")->default(0);
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
        Schema::dropIfExists('author_videocetagories');
    }
}
