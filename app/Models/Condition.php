<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Condition extends Model
{
    protected $fillable = [
        'name',
        'description',
        'value',
        'category_id'
    ];

    public function res_symptom(){
        return $this->hasMany(ResultSymptom::class, 'condition_id', 'id');
    }

}
