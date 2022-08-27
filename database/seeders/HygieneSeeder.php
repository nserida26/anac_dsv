<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class HygieneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 3 ; $i++) { 
            # code...
            DB::table('hygienes')->insert([
                'type' => 'Alimentaire',
                'description' => Str::random(20),
                'effectif' => 30,
                'intervenant_id' => 1,
                'projet_id' => 1
            ]);
        }

        //

    }
}
