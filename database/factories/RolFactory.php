<?php

namespace Database\Factories;

use App\Utils\ValuesDatabase;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rol>
 */
class RolFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            ValuesDatabase::ROL_COLUMN_NAME => fake()->word(),
            ValuesDatabase::ROL_COLUMN_DESCRIPTION => fake()->sentence(),
        ];
    }
}
