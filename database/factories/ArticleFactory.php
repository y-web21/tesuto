<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $titlePre = ['記事', 'テキスト', '社会風刺', '公開情報', '新着', '風説の流布', '事件概要'];
        return [
            'title' => $this->faker->randomElement($titlePre).'-'.$this->faker->randomNumber($nbDigits = 4),
            'content' => $this->faker->realText($maxNbChars = 1000, $indexSize = 2),
            'author' => random_int(0, 4),
            'status' => random_int(0, 4),
        ];
    }
}
