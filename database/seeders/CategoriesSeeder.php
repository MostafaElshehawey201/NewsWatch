<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                "category_name" => "سياسة",
                'user_id' => 1,
                'created_at' => now()
            ],
            [
                "category_name" => "اقتصاد",
                'user_id' => 1,
                'created_at' => now()
            ],
            [
                "category_name" => "رياضة",
                'user_id' => 1,
                'created_at' => now()
            ],
            [
                "category_name" => "تكنولوجيا",
                'user_id' => 1,
                'created_at' => now()
            ],
            [
                "category_name" => "فن",
                'user_id' => 1,
                'created_at' => now()
            ],
            [
                "category_name" => "صحة",
                'user_id' => 1,
                'created_at' => now()
            ],
            [
                "category_name" => "تعليم",
                'user_id' => 1,
                'created_at' => now(),
            ],
            [
                "category_name" => "منوعات",
                'user_id' => 1,
                "created_at" => now()
            ],
        ]);
    }
}
