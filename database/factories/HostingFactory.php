<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\HostingType;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hosting>
 */
class HostingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word(100),
            'active_from' => $this->faker->dateTimeBetween(
                '- 8 weeks',
                '- 4 weeks'
            ),
            'active_to' => $this->faker->dateTimeBetween(
                '- 1 week',
                '+ 5 weeks'
            ),
            'user_id' => User::select('id')
                ->orderByRaw('RAND()')
                ->first()->id,
            'hosting_type_id' => HostingType::select('id')
                ->orderByRaw('RAND()')
                ->first()->id,
            'created_at' => $this->faker->dateTimeBetween(
                '- 8 weeks',
                '- 4 weeks'
            ),
            'updated_at' => $this->faker->dateTimeBetween(
                '- 4 weeks',
                '- 1 week'
            ),
            'deleted_at' => rand(0, 10) === 0
                ? $this->faker->dateTimeBetween(
                    '- 1 week',
                    '+ 2 weeks'
                ) 
                : null
        ];
    }
}
