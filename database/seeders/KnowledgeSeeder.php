<?php

namespace Database\Seeders;

use App\Models\Disease;
use App\Models\Knowledge;
use App\Models\Symptom;
use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Database\Seeder;

class KnowledgeSeeder extends Seeder
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
        $disease = Disease::inRandomOrder()->pluck('id');
        $symptom = Symptom::inRandomOrder()->pluck('id');
        for($x = 0; $x < 100; $x++){
            $mb = (int) rand(0,1 ) . '.' . rand(1, 9);
            $md = (int) rand(0,1 ) . '.' . rand(1, 9);
            Knowledge::create([
                'measure_of_belief' => $mb,
                'measure_of_disbelief' => $md,
                'disease_id' => $disease->random(),
                'symptom_id' => $symptom->random(),
            ]);
        }
    }

    protected function withFaker()
    {
        return Container::getInstance()->make(Generator::class);
    }
}
