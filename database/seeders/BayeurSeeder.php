<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class BayeurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('bayeurs')->insert([
            'nom' => Str::random(10),
            'code' => Str::random(10),
            'tel' => 46727900,
            'adresse' => Str::random(5)
        ]);
    }
}
