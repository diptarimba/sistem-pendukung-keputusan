<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Knowledge extends Model
{
    protected $fillable = [
        'measure_of_belief',
        'measure_of_disbelief',
        'disease_id',
        'symptom_id',
    ];

    public function disease()
    {
        return $this->belongsTo(Disease::class, 'disease_id', 'id');
    }

    public function symptom()
    {
        return $this->belongsTo(Symptom::class, 'symptom_id', 'id');
    }

}
