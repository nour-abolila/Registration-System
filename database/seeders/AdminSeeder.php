<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            // هنا بق بسجل بيانات الادمن يدوى فى جدول اليوزرز
            'username' => 'admin',
            'email' => 'nour@gmail.com',
            'password' => Hash::make('nour2262519'),
            'role' => 'admin',
            'phone' => '01062465743',
            'city' => 'mansoura',
            'date_of_birth' => '2000-01-01',
        ]);
    }
}

// متنساش اروح استدعى السيدر دة فى ملف السيدر الاساسى
