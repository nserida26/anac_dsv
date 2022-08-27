<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LocaliteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i=0; $i < 3; $i++) { 
            # code...
            DB::table('localites')->insert([
                'libele' => Str::random(10),
                'population' => 3000,
                'altitude' => 17.23,
                'longitude' => -7.23,
                'commune_id' => 1
            ]);
        }

    }
}
