<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            'name' => "super admin",
            'email' => 'superadmin@superadmin.com',
            'password' => Hash::make('123456789'),
            'add_visit' => true,
            'finish_visit' => true,
        ]);
    }
}
