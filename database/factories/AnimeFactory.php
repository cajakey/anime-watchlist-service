<?php

namespace Database\Factories;

use App\Models\Anime;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnimeFactory extends Factory
{
    protected $model = Anime::class;

    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'genre' => $this->faker->word,
            'season' => $this->faker->numberBetween(1, 10),
            'episode' => $this->faker->numberBetween(1, 100),
        ];
    }
}