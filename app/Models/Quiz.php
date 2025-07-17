<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'time',
        'description',
        'status'
    ];

    protected $casts = [
        'time' => 'integer',
        'status' => 'string'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
