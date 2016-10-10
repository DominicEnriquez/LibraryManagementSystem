<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class RestrictionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('book_restriction')->insert([
            'max_duration' => '10',
            'max_loan' => '6',
            'junior_max_loan' => '3',
            'charge_expired' => '2.00'
        ]);
    }
}
