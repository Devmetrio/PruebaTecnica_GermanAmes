<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class LoginHistoryFactory extends Factory
{
    /**
     * Define el estado por defecto del modelo LoginHistory
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ip' => $this->faker->ipv4(),
            'user_agent' => $this->faker->userAgent(),
        ];
    }
}
