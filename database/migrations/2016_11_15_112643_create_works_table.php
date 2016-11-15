<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('works', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description')->default("");
            $table->string('img');
            $table->integer('artist_id');
            $table->boolean('opportunity')->default(false);
            $table->decimal('price', 6, 3)->nullable();
            $table->decimal('discount', 6, 3)->nullable();
            $table->softDeletes();
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
        //
        Schema::dropIfExists('works');
    }
}
