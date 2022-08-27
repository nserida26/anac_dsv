<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class LatrineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('latrines')->insert([
            'type_bloc' => '4',
            'nbr_bloc' => 2,
            'etat_bloc' => 'Separé',
            'infrastructure_id' => 2
        ]);
    }
}
