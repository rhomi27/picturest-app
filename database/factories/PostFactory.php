<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{


    protected $model = Post::class;
    /**
     * 
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        
        $file = [
            'img (1).jpg',
            'img (2).jpg',
            'img (3).jpg',
            'img (4).jpg',
            'img (5).jpg',
            'img (6).jpg',
            'img (7).jpg',
            'img (8).jpg',
            'img (9).jpg',
            'img (10).jpg'
        ];
        shuffle($file);
        $result = $file[0];
        return [
            "user_id" => mt_rand(2,6),
            "judul" => $this->faker->sentence(mt_rand(1, 4)),
            "deskripsi" => $this->faker->paragraph(),
            "tag" => $this->faker->words(2, true), // Menghasilkan dua kata acak
            "file" => $result,
        ];
    }
}
