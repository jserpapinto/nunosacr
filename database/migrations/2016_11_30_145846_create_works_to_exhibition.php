<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorksToExhibition extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('works_to_exhibition', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('exhibition_id');
            $table->integer('work_id');
            $table->boolean('featured_to_exhibition')->default(0);
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
        Schema::dropIfExists('works_to_exhibition');
    }
}
