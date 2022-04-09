<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StartupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome' => $this->faker->company,
            'descricao' => $this->faker->realText($maxNbChars = 200),
            'email' => $this->faker->email,
            'cnpj' => $this->faker->cnpj(false),
            'logo' => 'startups/logos/'.$this->faker->image($dir = storage_path('app/public/startups/logos'), $width = 640, $height = 480, null, false),
        ];
    }
}
