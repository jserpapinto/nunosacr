<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExhibitionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('exhibitions', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('img')->default("");
            $table->string('imgBanner')->default("");
            $table->boolean('featured')->default(0);
            $table->string('slug');
            $table->datetime('from')->nullable();
            $table->datetime('to')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.3
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('exhibitions');
    }
}
