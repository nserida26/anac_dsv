<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class CommuneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('communes')->insert([
            'libele' => Str::random(10),
            'population' => 3000,
            'altitude' => 17.23,
            'longitude' => -7.23
        ]);
    }
}
