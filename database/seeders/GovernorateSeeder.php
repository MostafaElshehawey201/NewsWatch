<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GovernorateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          DB::table('governorates')->insert([
            ['id' => 1, 'name_governorate' => 'القاهرة'],
            ['id' => 2, 'name_governorate' => 'الجيزة'],
            ['id' => 3, 'name_governorate' => 'الإسكندرية'],
            ['id' => 4, 'name_governorate' => 'الدقهلية'],
            ['id' => 5, 'name_governorate' => 'الشرقية'],
        ]);
    }
}
