<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
        // 'date',
        // 'disease',
        // 'symptom',
        'value',
    ];

    public function res_disease()
    {
        return $this->hasMany(ResultDisease::class, 'result_id', 'id');
    }

    public function disease(){
        return $this->hasManyThrough(Disease::class, ResultDisease::class, 'result_id', 'id', 'id', 'disease_id');
    }

    public function res_symptom()
    {
        return $this->hasMany(ResultSymptom::class, 'result_id', 'id');
    }

    public function symptom()
    {
        return $this->hasManyThrough(Symptom::class, ResultSymptom::class, 'result_id', 'id', 'id', 'symptom_id');
    }

}
