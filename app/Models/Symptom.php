<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Symptom extends Model
{
    protected $fillable = [
        'name',
        'category_id'
    ];

    public function knowledge()
    {
        return $this->hasMany(Knowledge::class, 'symptom_id', 'id');
    }

    public function symptom_category()
    {
        return $this->belongsTo(SymptomCategory::class, 'category_id', 'id');
    }

}
