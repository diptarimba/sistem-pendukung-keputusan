<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Symptom extends Model
{
    protected $fillable = [
        'name',
    ];

    public function knowledge()
    {
        return $this->OneToMany(Knowledge::class, 'symptom_id', 'id');
    }

}
