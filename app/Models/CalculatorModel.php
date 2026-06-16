<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalculatorModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'model',
        'base_price',
        'depreciation_rate',
    ];

    protected $casts = [
        'base_price' => 'decimal:2',
        'depreciation_rate' => 'decimal:2',
    ];
}
