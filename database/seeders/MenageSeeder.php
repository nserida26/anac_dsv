<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class MenageSeeder extends Seeder
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
            DB::table('menages')->insert([
                'designation' => Str::random(10),
                'nbr' => 300,
                'localite_id' => 1,
                'projet_id' => 1
            ]);
        }
    }
}
