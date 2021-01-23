<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'Super',
        ]);
    DB::table('roles')->insert([
        'name' => 'Admin',
    ]);
    DB::table('roles')->insert([
        'name' => 'Car',
    ]);
    
    DB::table('roles')->insert([
        'name' => 'Driver',
            ]);

         DB::table('roles')->insert([
                'name'=> 'Passenger',
            ]);
            
    }
}
