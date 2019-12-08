<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotoTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photo_tags', function (Blueprint $table) {
            $table->bigInteger('photo_id')->unsigned();
            $table->bigInteger('tag_id')->unsigned();
            $table->primary(['photo_id', 'tag_id']);

            $table->foreign('photo_id')
                ->references('id')
                ->on('photos')
                ->onDelete('cascade');
            $table->foreign('tag_id')
                ->references('id')
                ->on('tags')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('photo_tags');
    }
}
