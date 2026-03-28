<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    /** @use HasFactory<\Database\Factories\OfferFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'discount_percentage',
        'discount_code',
        'valid_until',
    ];

    protected function casts(): array
    {
        return [
            'valid_until' => 'datetime',
        ];
    }
}
