<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'name_en' => 'shop',
            'name_ar' => 'سوق',
            'email' => 'mahroustamim@gmail.com',
        ]);
    }
}
