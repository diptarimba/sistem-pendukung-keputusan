<?php

namespace Database\Seeders;

use App\Models\User;
use Facade\Ignition\Support\FakeComposer;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(2)->state(new Sequence(
            ['username' => 'admin1'],
            ['username' => 'admin2']
        ))->create();
    }
}
