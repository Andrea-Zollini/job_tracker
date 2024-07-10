<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            'Yoshikage Kira',
            'Light Yagami',
        ];

        foreach ($names as $name) {
            $email = strtolower(str_replace(' ', '_', $name)) . '@test.com';
            User::factory()->create([
                'name' => $name,
                'email' => $email,
            ]);
        }
    }
}
