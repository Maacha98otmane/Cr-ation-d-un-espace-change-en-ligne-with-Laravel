<?php

namespace Database\Factories;

use App\Models\Sujet;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SujetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sujet::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title(),
            'Contenu' => $this->faker->paragraph(),
            'user_id' => User::factory(),
        ];
    }
    
}
