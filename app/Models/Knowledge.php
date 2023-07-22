<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Knowledge extends Model
{
    protected $fillable = [
        'measure_of_belief',
        'measure_of_disbelief',
        'disease_id',
        'symtom_id',
    ];

    public function disease()
    {
        return $this->belongsTo(disease::class, 'disease_id', 'id');
    }

    public function symptom()
    {
        return $this->belongsTo(symptom::class, 'symtom_id', 'id');
    }

}
