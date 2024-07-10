<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobApplication>
 */
class JobApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::get()->random();
        return [
            'user_id' => $user->id,
            'job_title' => 'Test Job Title',
            'description' => 'Test Description',
            'company_name' => 'Test Company Name',
            'location' => 'Test Location',
        ];
    }
}
