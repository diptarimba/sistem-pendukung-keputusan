<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    protected $fillable = [
        'name',
        'determine',
        'suggestion',
        'image',
    ];

    public function knowledge()
    {
        return $this->OneToMany(knowledge::class, 'disease_id', 'id');
    }

}
