<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;



class ConditionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('conditions')->insert([
            ['condition' => 'Ohne Zeitlimit', 'taken' => 0],
            ['condition' => 'Zeitlimit: 30 Sekunden', 'taken' => 0],
            ['condition' => 'Zeitlimit: 15 Sekunden', 'taken' => 0],
        ]);
    }
}
