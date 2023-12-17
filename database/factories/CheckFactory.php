<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Check>
 */
class CheckFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'phone_number' => '01947474747',
            'code' => 'abcdxyz',
            'remarks' => 'firsttime',
            'location' => 'dhaka',
            'source' => 'sms',
            'created_at' => $this->faker->unique()->dateTimeBetween('-12 months', '+12 months')->format('Y-m-d'),
        ];
    }
}
