<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobApplication>
 */
class JobApplicationFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::get()->random();
        $tecnologies = ['PHP', 'Laravel', 'Vue', 'Tailwind', 'React', 'Angular', 'JavaScript', 'Python', 'Hono', 'Node'];
        return [
            'user_id' => $user->id,
            'job_title' => $job_title = 'Test Job Title',
            'slug' => Str::slug($job_title),
            'description' => 'Test Description',
            'company_name' => 'Test Company Name',
            'location' => 'Test Location',
            'metadata' => json_encode(['technologies' => $this->faker->randomElements($tecnologies, 3)]),
        ];
    }
}
