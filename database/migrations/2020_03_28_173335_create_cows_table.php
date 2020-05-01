<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cows', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->Integer('bread_id')->nullable();
            $table->Integer('seller_id')->nullable();
            $table->Integer('buyer_id')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('age')->nullable();
            $table->double('weight')->nullable();
            $table->double('buy_price')->nullable();
            $table->double('sell_price')->nullable();
            $table->integer('purpose')->nullable();
            $table->integer('type')->nullable();
            $table->string('image')->nullable();
            $table->text('details')->nullable();
            $table->tinyInteger('active_status')->default(1);
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
        Schema::dropIfExists('cows');
    }
}