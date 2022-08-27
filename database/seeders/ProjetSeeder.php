<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class ProjetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('projets')->insert([
            'designation' => Str::random(10),
            'code' => Str::random(10),
            'date_debut' => '2022-08-08',
            'date_fin' => '2022-09-08',
            'bayeur_id' => 1
        ]);
    }
}
