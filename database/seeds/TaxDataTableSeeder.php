<?php

use Illuminate\Database\Seeder;

class TaxDataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tax_data')->insert([
            'user_id' => 2,
            'income' => 30000,
            'tax_rate' => 13,
            'deductions' => 2000,
            'paid' => 0,
            ]);
    }
}
