<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuyFoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buy_foods', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('food_id')->nullable();
            $table->string('buy_date')->nullable();
            $table->double('price')->nullable();
            $table->double('quantity')->nullable();
            $table->double('total')->nullable();
            $table->string('voucher')->nullable();
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
        Schema::dropIfExists('buy_foods');
    }
}