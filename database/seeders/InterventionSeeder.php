<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class InterventionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
                //
        DB::table('interventions')->insert([
            'designation' => Str::random(10),
            'code' => Str::random(10),
            'montant' => 10000,
            'avancement' => 'Lancement',
            'projet_id' => 1,
            'intervenant_id' => 1
        ]);
    }
}
