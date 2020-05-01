<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user =new User();
        $user->role_id= '1';
        $user->name="Super Admin";
        $user->email="1000157@daffodil.ac";
        $user->password=bcrypt('12345678');
        $user->name="Super Admin";
        $user->phone="123456789";
        $user->save();
    }
}