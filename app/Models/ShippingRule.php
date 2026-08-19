<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShippingRule extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'min_weight',
        'max_weight', // nullable for "greater than" range
        'fee',
    ];

    protected $casts = [
        'min_weight' => 'float',
        'max_weight' => 'float',
        'fee' => 'float',
    ];
}
