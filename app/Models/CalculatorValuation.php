<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalculatorValuation extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'model',
        'year',
        'condition',
        'mileage',
        'estimated_price',
    ];

    protected $casts = [
        'estimated_price' => 'decimal:2',
        'year' => 'integer',
        'mileage' => 'integer',
    ];
}
