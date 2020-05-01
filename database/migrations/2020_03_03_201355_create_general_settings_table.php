<?php

use App\GeneralSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeneralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('site_name');
            $table->string('site_title');
            $table->string('location');
            $table->string('email');
            $table->string('phone');
            $table->string('f_url');
            $table->string('t_url');
            $table->string('g_url');
            $table->string('i_url');
            $table->string('copyright_text');
            $table->string('logo');
            $table->string('fav');
            $table->tinyInteger('active_status')->default(1);
            $table->integer('created_by')->nullable()->default(1)->unsigned();
            $table->integer('updated_by')->nullable()->default(1)->unsigned();
            $table->timestamps();
        });

            //$faker = Factory::create();
            $general_setting = new GeneralSetting();
            $general_setting->site_name = 'Green Agro';
            $general_setting->site_title = "Cow Farm Management System";
            $general_setting->location = 'West-Shewrapara, Mirpur-10.';
            $general_setting->email = '1000157@daffodil.ac';
            $general_setting->phone = '+8801742857306';
            $general_setting->f_url = 'https://www.facebook.com/';
            $general_setting->t_url = 'https://twitter.com/';
            $general_setting->g_url = 'https://github.com/';
            $general_setting->i_url = 'https://www.instagram.com/';
            $general_setting->copyright_text = 'Copyright © 2020. All rights reserved to RaYHaN';
            $general_setting->logo = 'backend/uploads/logo/logo.png';
            $general_setting->fav = 'backend/uploads/logo/fav.jpg';
            $general_setting->save(); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('general_settings');
    }
}