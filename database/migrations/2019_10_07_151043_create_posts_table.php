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
            $table->string('title', 155)->nullable();
            $table->string('uuid', 191)->nullable();
            $table->bigInteger('category_id')->nullable();
            $table->bigInteger('option_id')->nullable();
            $table->float('price')->nullable();
            $table->string('email', 55)->nullable();
            $table->string('phone', 55)->nullable();
            $table->string('link', 191)->nullable();
            $table->text('description')->nullable();
            $table->integer('clicks')->default(0);
            $table->integer('status')->default(1);
            $table->timestamp('expire_date')->nullable();
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
