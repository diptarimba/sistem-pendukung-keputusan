<?php

namespace Database\Seeders;

use App\Models\Condition;
use Illuminate\Database\Seeder;

class ConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                "name" => "Pasti Ya",
                "description" => "",
                "value" => 1
            ],
            [
                "name" => "Hampir pasti ya",
                "description" => "",
                "value" => 0.8
            ],
            [
                "name" => "Kemungkinan besar ya",
                "description" => "",
                "value" => 0.6
            ],
            [
                "name" => "Mungkin ya",
                "description" => "",
                "value" => 0.4
            ],
            [
                "name" => "Tidak tahu",
                "description" => "",
                "value" => -0.2
            ],
            [
                "name" => "Mungkin Tidak",
                "description" => "",
                "value" => -0.4
            ],
            [
                "name" => "Kemungkinan Besar Tidak",
                "description" => "",
                "value" => -0.6
            ],
            [
                "name" => "Hampir pasti tidak",
                "description" => "",
                "value" => -0.8
            ],
            [
                "name" => "Pasti Tidak",
                "description" => "",
                "value" => -1
            ],
        ];

        Condition::insert($data);
    }
}
