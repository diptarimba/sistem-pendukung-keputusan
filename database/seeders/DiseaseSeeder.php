<?php

namespace Database\Seeders;

use App\Models\Disease;
use Illuminate\Database\Seeder;

class DiseaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            Disease::create([
                'name' => "Disease $i",
                'determine' => "Determine for Disease $i",
                'suggestion' => "Suggestion for Disease $i",
                'image' => '/storage/placeholder/avatar/default-profile.png'
            ]);
        }
    }
}
