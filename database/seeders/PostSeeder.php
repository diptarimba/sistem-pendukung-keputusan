<?php

namespace Database\Seeders;

use App\Models\Post;
use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected $faker;

    public function __construct()
    {
        $this->faker = $this->withFaker();
    }

    public function run()
    {
        for($x = 0; $x < 5; $x++){
            Post::create([
                'name' => $this->faker->name(),
                'determine' => $this->faker->randomHtml(),
                'suggestion' => $this->faker->randomHtml(),
                'image' => $this->faker->imageUrl()
            ]);
        }
    }

    protected function withFaker()
    {
        return Container::getInstance()->make(Generator::class);
    }
}
