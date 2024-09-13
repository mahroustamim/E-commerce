<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GovernoratesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $governorates = [
            ['governorate_en' => 'Cairo', 'governorate_ar' => 'القاهرة', 'delivery_price' => 30],
            ['governorate_en' => 'Giza', 'governorate_ar' => 'الجيزة', 'delivery_price' => 25],
            ['governorate_en' => 'Alexandria', 'governorate_ar' => 'الإسكندرية', 'delivery_price' => 35],
            ['governorate_en' => 'Qalyubia', 'governorate_ar' => 'القليوبية', 'delivery_price' => 20],
            ['governorate_en' => 'Port Said', 'governorate_ar' => 'بورسعيد', 'delivery_price' => 40],
            ['governorate_en' => 'Suez', 'governorate_ar' => 'السويس', 'delivery_price' => 35],
            ['governorate_en' => 'Dakahlia', 'governorate_ar' => 'الدقهلية', 'delivery_price' => 30],
            ['governorate_en' => 'Sharqia', 'governorate_ar' => 'الشرقية', 'delivery_price' => 25],
            ['governorate_en' => 'Gharbia', 'governorate_ar' => 'الغربية', 'delivery_price' => 25],
            ['governorate_en' => 'Monufia', 'governorate_ar' => 'المنوفية', 'delivery_price' => 20],
            ['governorate_en' => 'Beheira', 'governorate_ar' => 'البحيرة', 'delivery_price' => 35],
            ['governorate_en' => 'Kafr El Sheikh', 'governorate_ar' => 'كفر الشيخ', 'delivery_price' => 30],
            ['governorate_en' => 'Damietta', 'governorate_ar' => 'دمياط', 'delivery_price' => 40],
            ['governorate_en' => 'Ismailia', 'governorate_ar' => 'الإسماعيلية', 'delivery_price' => 35],
            ['governorate_en' => 'Faiyum', 'governorate_ar' => 'الفيوم', 'delivery_price' => 20],
            ['governorate_en' => 'Beni Suef', 'governorate_ar' => 'بني سويف', 'delivery_price' => 25],
            ['governorate_en' => 'Minya', 'governorate_ar' => 'المنيا', 'delivery_price' => 25],
            ['governorate_en' => 'Assiut', 'governorate_ar' => 'أسيوط', 'delivery_price' => 30],
            ['governorate_en' => 'Sohag', 'governorate_ar' => 'سوهاج', 'delivery_price' => 30],
            ['governorate_en' => 'Qena', 'governorate_ar' => 'قنا', 'delivery_price' => 30],
            ['governorate_en' => 'Aswan', 'governorate_ar' => 'أسوان', 'delivery_price' => 35],
            ['governorate_en' => 'Luxor', 'governorate_ar' => 'الأقصر', 'delivery_price' => 35],
            ['governorate_en' => 'Red Sea', 'governorate_ar' => 'البحر الأحمر', 'delivery_price' => 50],
            ['governorate_en' => 'Matruh', 'governorate_ar' => 'مطروح', 'delivery_price' => 50],
            ['governorate_en' => 'North Sinai', 'governorate_ar' => 'شمال سيناء', 'delivery_price' => 60],
            ['governorate_en' => 'South Sinai', 'governorate_ar' => 'جنوب سيناء', 'delivery_price' => 60],
            ['governorate_en' => 'New Valley', 'governorate_ar' => 'الوادي الجديد', 'delivery_price' => 50],
        ];

        DB::table('governorates')->insert($governorates);
    }
}
