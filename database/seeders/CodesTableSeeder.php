<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Code;

class CodesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run() : void
    {
        // Define the number of codes you want to generate
        $numberOfCodes = 1000;

        for ($i = 0; $i < $numberOfCodes; $i++) {
            // Generate a random 6-character code
            $code = substr(md5(uniqid(rand(), true)), 0, 6);

            // Insert the code into the database with 'used' set to 0 (false)
            Code::create([
                'code' => $code,
                'used' => 0,
            ]);
        }
    }
}
