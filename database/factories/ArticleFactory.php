<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $authorId = [0,1,2,3,4,5,6,7,11,12];
        return [
            'title' => $this->faker->city,
            'content' => $this->faker->realText($maxNbChars = 1000, $indexSize = 2),
            // 'author' => $this->faker->randomElement($authorId)
            'author' => random_int(0, 20)
        ];
    }
}
