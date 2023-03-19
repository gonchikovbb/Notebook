<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notebook>
 */
class NotebookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->name,
            'last_name' => $this->faker->name,
            'third_name' => $this->faker->name,
            'company' => $this->faker->name,
            'phone' => $this->faker->unique()->safeEmail(),
            'email' => $this->faker->unique()->safeEmail(),
            'date_birth' => $this->faker->dateTimeThisMonth()->format('Y-m-d'),
            'photo_path' => Storage::disk('public')->putFile('uploads', new File($this->faker->image())),
            'photo_name' => $this->faker->name,
        ];
    }
}
