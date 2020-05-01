<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellMilksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sell_milks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('milk_buyer_id')->nullable();
            $table->string('sell_date')->nullable();
            $table->double('price')->nullable();
            $table->double('quantity')->nullable();
            $table->double('total')->nullable();
            $table->tinyInteger('payment_status')->default(0);
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('sell_milks');
    }
}