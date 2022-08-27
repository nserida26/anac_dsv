<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class IISeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 2 ; $i++) { 
            # code...
            DB::table('infrastructure_interventions')->insert([
                'infrastructure_id' => 1,
                'intervention_id' => 1,
                'date_intervention' => '2022-02-12'
            ]);
        }

        //

    }
}
