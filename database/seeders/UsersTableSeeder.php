<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'role_id'=> '1',
            'name' => 'Super',
            'email' => 'super@gmail.com',
            'phone' => '123456789',
            'image'=> 'malesh.png',
            'password' => bcrypt('123456789'),
            'about' => 'this is Super',
        ]);
        DB::table('users')->insert([
            'role_id' => '2',
            'name' => 'Admin',         
            'email' => 'admin@gmail.com',
            'phone' => '123456789',
            'image'=> 'malesh.png',
            'about' => 'this is Admin',
            'password' => bcrypt('123456789'),
        ]);
        
         DB::table('users')->insert([
       'role_id' => '3',
       'name' => 'Car',     
       'email' => 'car@gmail.com',
       'phone' => '123456789',
       'image'=> 'malesh.png',
       'about' => 'this is Car',
       'password' => bcrypt('123456789'),
   ]);

   DB::table('users')->insert([
       'role_id' => '4',
       'name' => 'Driver',
       'email' => 'driver@gmail.com',
       'phone' => '123456789',
       'image'=> 'malesh.png',
       'about' => 'this is Driver',
       'password' => bcrypt('123456789'),
   ]);
   DB::table('users')->insert([
       'role_id' => '5',
       'name' => 'Passenger',
       'email' => 'passenger@gmail.com',
       'phone' => '123456789',
       'image'=> 'malesh.png',
       'about' => 'this is Passenger',
       'password' => bcrypt('123456789'),
   ]);

}
}
