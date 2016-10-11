<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_profile')->insert([
            'user_id' => 1,
            'contact_number' => '+63927XXXXXXX',
            'firstname' => 'Dominic',
            'lastname' => 'Enriquez',
            'middlename' => 'G.',
            'address' => 'Makati City, Philippines',
            'gender' => 'male',
            'birthdate' => '1989-09-28'
        ]);
    }
}
