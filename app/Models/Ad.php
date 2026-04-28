<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'price',
        'brand',
        'model',
        'year',
        'condition',
        'location',
        'image',
        'views',
        'engagement',
        'is_active',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
