<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'mahrous',
            'email' => 'mahroustamim@gmail.com',
            'password' => Hash::make('12345678'),
            'status' => 'admin',
            'email_verified_at' => now(),
            'governotate_id' => 11,
            'phone' => '01121665185',
        ]);
    }
}
