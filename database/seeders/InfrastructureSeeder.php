<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class InfrastructureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //for ($i=0; $i < 3 ; $i++) { 
            # code...
            DB::table('infrastructures')->insert([
                'designation' => Str::random(20),
                'date_construction' => '2020-01-01',
                'effectif' => 10000,
                'etat' => 'Fonctionnel',
                'altitude' => 16.465,
                'longitude' => -6.327,
                'localite_id' => 1,
                'type_id' => 1,
                'source_eau' => Str::random(10) 
            ]);
        //}
    }
}
