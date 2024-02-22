<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('services')->insert([
            'service_title' => 'Commercial Security Service',
        ]);
        DB::table('services')->insert([
            'service_title' => 'Residence Security Service',
        ]);
        DB::table('services')->insert([
            'service_title' => 'Hotels & Malls Security Service',
        ]);
        DB::table('services')->insert([
            'service_title' => 'Gunman',
        ]);
    }
}
