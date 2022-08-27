<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class IntervenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('intervenants')->insert([
            'nom' => Str::random(10),
            'code' => Str::random(10),
            'tel' => 46727900,
            'adresse' => Str::random(5)
        ]);
    }
}
