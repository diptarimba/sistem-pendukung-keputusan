<?php

namespace Database\Seeders;

use App\Models\Symptom;
use App\Models\SymptomCategory;
use Illuminate\Database\Seeder;

class SymptomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $symptomCategory = [
            [
                "name" => 'Pengecekan Etrus'
            ],[
                "name" => 'Pengecekan Kesehatan Reproduksi & Body Condition Score'
            ],[
                "name" => 'Pengamatan Siklus Reproduksi (Fase Pre Etrus, Etrus, Men Etrus, Dietrus)'
            ]
        ];
        SymptomCategory::insert($symptomCategory);
        $data =[
            "Untuk si betina, apakah ada pemerahan pada vulva?",
            "Apakah si betina memiliki kecenderungan terhadap si pejantan?",
            "Apakah perilaku hewan mulai berubah seperti gelisah, mencari perhatian lebih, atau lebih aktif secara fisik?",
            "Apakah ada peningkatan bengkak pada vulva atau keluarnya lendir dari vulva?",
            "Apakah perilaku hewan berubah menjadi agresif?",
            "Apakah nafsu makan menurun tetapi dalam kondisi sehat?",
            "Apakah ekor berbentuk huruf 'O' ?",
            "Apakah sapi sering melenguh panjang?",
        ];
        foreach($data as $each){
            Symptom::create([
                'name' => $each,
                'category_id' => 1
            ]);
        }

        $data =[
            "Apakah hewan mengalami kelainan fisik?",
            "Apakah hewan pernah mengalami gejala infeksi pada organ reproduksi?",
            "Apakah ada penyumbatan pada serviks hewan?",
            "Apakah Anda mengamati bagian tubuh lain, seperti pangkal ekor, leher, atau paha, untuk menilai kondisi tubuh hewan ternak sapi/kambing Anda secara keseluruhan?",
            "Apakah tulang punggung atau tulang rusuk hewan ternak sapi/kambing Anda terlihat menonjol atau terasa dengan mudah saat disentuh?",
            "Berapa berat badan perkiraan hewan ternak sapi/kambing Anda saat ini?",
            "Berapakah umur sapi/kambing?",
            "Apakah siklus birahi sapi terjadi selama 3 hari?",
        ];
        foreach($data as $each){
            Symptom::create([
                'name' => $each,
                'category_id' => 2
            ]);
        }

        $data =[
            "Apakah terdapat lendir pada organ kelamin betina?",
            "Apakah vulva belum membengkakdan belum merah, jika dilihat pada bagian dalam vulva masih berwarna merah muda?",
        ];
        foreach($data as $each){
            Symptom::create([
                'name' => $each,
                'category_id' => 2
            ]);
        }
    }
}
