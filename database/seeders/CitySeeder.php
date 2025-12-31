<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('cities')->insert([
            // القاهرة
            ['name_city' => 'مدينة نصر', 'governorate_id' => 1],
            ['name_city' => 'المعادي', 'governorate_id' => 1],
            ['name_city' => 'حلوان', 'governorate_id' => 1],

            // الجيزة
            ['name_city' => 'الدقي', 'governorate_id' => 2],
            ['name_city' => 'المهندسين', 'governorate_id' => 2],
            ['name_city' => '6 أكتوبر', 'governorate_id' => 2],

            // الإسكندرية
            ['name_city' => 'سيدي جابر', 'governorate_id' => 3],
            ['name_city' => 'محرم بك', 'governorate_id' => 3],
            ['name_city' => 'العجمي', 'governorate_id' => 3],

            // الدقهلية
            ['name_city' => 'المنصورة', 'governorate_id' => 4],
            ['name_city' => 'طلخا', 'governorate_id' => 4],

            // الشرقية
            ['name_city' => 'الزقازيق', 'governorate_id' => 5],
            ['name_city' => 'بلبيس', 'governorate_id' => 5],
        ]);
    }
}
