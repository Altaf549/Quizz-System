<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'status',
        'image'
    ];

    protected $casts = [
        'status' => 'string'
    ];

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }
}
