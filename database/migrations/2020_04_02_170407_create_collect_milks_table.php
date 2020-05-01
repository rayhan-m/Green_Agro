<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectMilksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collect_milks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('cow_id');
            $table->string('date_time')->nullable();
            $table->double('quantity')->nullable();
            $table->tinyInteger('active_status')->default(0);
            $table->integer('created_by')->nullable()->default(1)->unsigned();
            $table->integer('updated_by')->nullable()->default(1)->unsigned();
            // $table->foreign('cow_id')->references('id')->on('cows')->onDelete('restrict');
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
        Schema::dropIfExists('collect_milks');
    }
}