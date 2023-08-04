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
                "name" => 'Kelelahan'
            ],[
                "name" => 'Obesitas'
            ]
        ];
        SymptomCategory::insert($symptomCategory);
        $data =[
            "Nafsu makan berkurang",
            "Nafas sesak / megap-megap",
            "Nafas ngorok basah",
            "Bersin-bersin",
            "Batuk",
            "Kerabang telur pucat",
            "Bulu kusam dan berkerut",
            "Diare",
            "Produksi telur menurun",
            "Kedinginan",
            "Tampak lesu",
            "Mencret kehijau-hijauan",
            "Mencret keputih-putihan",
            "Muka pucat",
            "Nampak membiru",
            "Pembengkakan pial",
            "Jengger pucat",
            "Kaki dan sayap lumpuh",
            "Keluar cairan dari mata dan hidung",
            "Kepala bengkak",
            "Kepala terputar",
            "Pembengkakan dari sinus dan mata",
            "Perut membesar",
            "Sayap menggantung",
            "Terdapat kotoran putih menempel disekitar anus",
        ];
        foreach($data as $each){
            Symptom::create([
                'name' => $each,
                'category_id' => 1
            ]);
        }

        $data =[
            "Mati secara mendadak",
            "Kerabang telur kasar",
            "Putih Telur Encer",
            "Kotoran kuning kehijauan",
            "Pembengkakan daerah fasial dan sekitar mata",
            "Kotoran atau feses berdarah",
            "Bergerombol di sudut kandang",
            "Mematuk daerah kloaka",
            "Telur lebih kecil",
            "Kelumpuhan pada tembolok",
            "Bernafas dengan mulut sambil menjulurkan leher",
            "Batuk berdarah",
            "Tidur paruhnya diletakkan dilantai",
            "Duduk dengan sikap membungkuk",
            "Kelihatan mengantuk dengan bulu berdiri",
            "Badan kurus",
            "Terdapat lendir bercampur darah pada rongga mulut",
            "Kaki pincang"
        ];
        foreach($data as $each){
            Symptom::create([
                'name' => $each,
                'category_id' => 2
            ]);
        }
    }
}
