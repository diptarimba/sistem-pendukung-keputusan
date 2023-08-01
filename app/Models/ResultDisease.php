<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultDisease extends Model
{
    use HasFactory;

    protected $fillable = [
        'result_id',
        'disease_id'
    ];

    public function result()
    {
        return $this->belongsTo(Result::class, 'result_id', 'id');
    }

    public function disease()
    {
        return $this->belongsTo(Disease::class, 'disease_id', 'id');
    }
}
