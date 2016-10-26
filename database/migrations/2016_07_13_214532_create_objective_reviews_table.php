<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Createobjective_reviewsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objective_reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->text('description');
            $table->string('rating');
            $table->integer('evaluation_id');
            $table->integer('objective_id');
            $table->integer('user_id');
            $table->text('stage');
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
        Schema::drop('objective_reviews');
    }
}
