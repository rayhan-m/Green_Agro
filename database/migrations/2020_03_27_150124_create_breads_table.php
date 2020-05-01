<?php

use App\Bread;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBreadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('breads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->tinyInteger('active_status')->default(1);
            $table->integer('created_by')->nullable()->default(1)->unsigned();
            $table->integer('updated_by')->nullable()->default(1)->unsigned();
            $table->timestamps();
        });

            $bread = new Bread();
            $bread->name = "Holstein";
            $bread->save();
            $bread = new Bread();
            $bread->name = "Friesian";
            $bread->save();
            $bread = new Bread();
            $bread->name = "Sahiwal";
            $bread->save();
            $bread = new Bread();
            $bread->name = "Sindhi ";
            $bread->save();
            $bread = new Bread();
            $bread->name = "Jersey ";
            $bread->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('breads');
    }
}