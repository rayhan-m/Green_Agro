<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedFoodItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feed_food_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('food_id')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('feed_food_id')->nullable();
            $table->tinyInteger('active_status')->default(0);
            $table->integer('created_by')->nullable()->default(1)->unsigned();
            $table->integer('updated_by')->nullable()->default(1)->unsigned();
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
        Schema::dropIfExists('feed_food_items');
    }
}