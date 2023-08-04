<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SymptomCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function symptom()
    {
        return $this->hasMany(Symptom::class, 'category_id', 'id');
    }
}
