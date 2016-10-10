<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'is_admin' => 'yes',
            'email' => 'admin@domain.com',
            'password' => bcrypt('password')
        ]);
    }
}
