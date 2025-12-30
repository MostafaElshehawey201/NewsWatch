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
            ['id' => 1, 'name' => 'القاهرة'],
            ['id' => 2, 'name' => 'الجيزة'],
            ['id' => 3, 'name' => 'الإسكندرية'],
            ['id' => 4, 'name' => 'الدقهلية'],
            ['id' => 5, 'name' => 'الشرقية'],
        ]);
    }
}
