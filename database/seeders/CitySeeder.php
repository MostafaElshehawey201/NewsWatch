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
            ['name' => 'مدينة نصر', 'governorate_id' => 1],
            ['name' => 'المعادي', 'governorate_id' => 1],
            ['name' => 'حلوان', 'governorate_id' => 1],

            // الجيزة
            ['name' => 'الدقي', 'governorate_id' => 2],
            ['name' => 'المهندسين', 'governorate_id' => 2],
            ['name' => '6 أكتوبر', 'governorate_id' => 2],

            // الإسكندرية
            ['name' => 'سيدي جابر', 'governorate_id' => 3],
            ['name' => 'محرم بك', 'governorate_id' => 3],
            ['name' => 'العجمي', 'governorate_id' => 3],

            // الدقهلية
            ['name' => 'المنصورة', 'governorate_id' => 4],
            ['name' => 'طلخا', 'governorate_id' => 4],

            // الشرقية
            ['name' => 'الزقازيق', 'governorate_id' => 5],
            ['name' => 'بلبيس', 'governorate_id' => 5],
        ]);
    }
}
