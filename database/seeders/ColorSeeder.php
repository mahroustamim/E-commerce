<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            'أسود',  // Black
            'أبيض',  // White
            'أحمر',  // Red
            'أزرق',  // Blue
            'أخضر',  // Green
            'أصفر',  // Yellow
            'بنفسجي', // Purple
            'برتقالي', // Orange
            'رمادي',  // Grey
            'وردي' ,  // Pink
        ];

        foreach ($colors as $color) {
            DB::table('color')->insert(['color' => $color]);
        }
    }
}
