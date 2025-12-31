<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Sube_CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sub_categories')->insert([

            // سياسة
            ['subCategory_name' => 'سياسة محلية', 'category_id' => 1, 'created_at' => now()],
            ['subCategory_name' => 'سياسة دولية', 'category_id' => 1, 'created_at' => now()],
            ['subCategory_name' => 'البرلمان', 'category_id' => 1, 'created_at' => now()],
            ['subCategory_name' => 'قرارات حكومية', 'category_id' => 1, 'created_at' => now()],

            // اقتصاد
            ['subCategory_name' => 'البورصة', 'category_id' => 2, 'created_at' => now()],
            ['subCategory_name' => 'البنوك', 'category_id' => 2, 'created_at' => now()],
            ['subCategory_name' => 'العملات', 'category_id' => 2, 'created_at' => now()],
            ['subCategory_name' => 'الاستثمار', 'category_id' => 2, 'created_at' => now()],

            // رياضة
            ['subCategory_name' => 'كرة قدم', 'category_id' => 3, 'created_at' => now()],
            ['subCategory_name' => 'كرة سلة', 'category_id' => 3, 'created_at' => now()],
            ['subCategory_name' => 'دوري مصري', 'category_id' => 3, 'created_at' => now()],
            ['subCategory_name' => 'انتقالات', 'category_id' => 3, 'created_at' => now()],

            // تكنولوجيا
            ['subCategory_name' => 'ذكاء اصطناعي', 'category_id' => 4, 'created_at' => now()],
            ['subCategory_name' => 'موبايلات', 'category_id' => 4, 'created_at' => now()],
            ['subCategory_name' => 'برمجيات', 'category_id' => 4, 'created_at' => now()],
            ['subCategory_name' => 'أمن معلومات', 'category_id' => 4, 'created_at' => now()],

            // فن
            ['subCategory_name' => 'سينما', 'category_id' => 5, 'created_at' => now()],
            ['subCategory_name' => 'مسلسلات', 'category_id' => 5, 'created_at' => now()],
            ['subCategory_name' => 'موسيقى', 'category_id' => 5, 'created_at' => now()],
            ['subCategory_name' => 'مشاهير', 'category_id' => 5, 'created_at' => now()],

            // صحة
            ['subCategory_name' => 'صحة عامة', 'category_id' => 6, 'created_at' => now()],
            ['subCategory_name' => 'تغذية', 'category_id' => 6, 'created_at' => now()],
            ['subCategory_name' => 'أمراض', 'category_id' => 6, 'created_at' => now()],
            ['subCategory_name' => 'لياقة بدنية', 'category_id' => 6, 'created_at' => now()],

            // تعليم
            ['subCategory_name' => 'تعليم جامعي', 'category_id' => 7, 'created_at' => now()],
            ['subCategory_name' => 'تعليم مدرسي', 'category_id' => 7, 'created_at' => now()],
            ['subCategory_name' => 'منح دراسية', 'category_id' => 7, 'created_at' => now()],
            ['subCategory_name' => 'كورسات', 'category_id' => 7, 'created_at' => now()],

            // منوعات
            ['subCategory_name' => 'لايف ستايل', 'category_id' => 8, 'created_at' => now()],
            ['subCategory_name' => 'سفر وسياحة', 'category_id' => 8, 'created_at' => now()],
            ['subCategory_name' => 'قصص إنسانية', 'category_id' => 8, 'created_at' => now()],
            ['subCategory_name' => 'غرائب', 'category_id' => 8, 'created_at' => now()],
        ]);
    }
}
