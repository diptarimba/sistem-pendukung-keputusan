<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultSymptom extends Model
{
    use HasFactory;

    protected $fillable = [
        'result_id',
        'symptom_id'
    ];

    public function result()
    {
        return $this->belongsTo(Result::class, 'result_id', 'id');
    }

    public function symptom()
    {
        return $this->belongsTo(Symptom::class, 'symptom_id', 'id');
    }
}
