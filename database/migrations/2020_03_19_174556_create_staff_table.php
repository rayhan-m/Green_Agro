<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name', 100)->nullable();
            $table->string('last_name', 100)->nullable();
            $table->string('full_name', 200)->nullable();
            $table->string('fathers_name', 100)->nullable();
            $table->string('mothers_name', 100)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->date('date_of_joining')->nullable();
            $table->string('email', 50)->nullable();
            $table->string('mobile', 50)->nullable();
            $table->string('emergency_mobile', 50)->nullable();
            $table->string('marital_status', 30)->nullable();
            $table->string('gender_id')->nullable();
            $table->string('staff_photo')->nullable();
            $table->string('basic_salary')->nullable();
            $table->string('nid')->nullable();
            $table->text('current_address')->nullable();
            $table->text('permanent_address')->nullable();
            $table->text('qualification')->nullable();
            $table->text('experience')->nullable();
            $table->tinyInteger('active_status')->default(1);
            $table->integer('created_by')->nullable()->default(1)->unsigned();
            $table->integer('updated_by')->nullable()->default(1)->unsigned();
            $table->timestamps();
        });
        DB::table('staff')->insert([
            [
                
                'first_name'       => 'M. Fitzpatrick',
                'last_name'        => 'kBernard',
                'full_name'        => 'M. Fitzpatric Bernard',
                'fathers_name'        => 'Bernard',
                'date_of_birth'    => date('Y-m-d'),
                'date_of_joining'  => date('Y-m-d'),
                'gender_id'        => 1,
                'email'            => 'staff@gmail.com',
                'mobile'           => '123456789',
                'emergency_mobile' => '1234567890',
                'marital_status'   => 'married',
                'nid'              => '123456789',
                'staff_photo'      => 'backend/uploads/staff/staff.jpg',
                'qualification'    => 'B.Sc in Computer Science',
                'experience'       => '4 Years',
                'basic_salary'     => 45000,
                'created_at' => date('Y-m-d h:i:s')
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff');
    }
}