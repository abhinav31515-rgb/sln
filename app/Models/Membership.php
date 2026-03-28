<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    /** @use HasFactory<\Database\Factories\MembershipFactory> */
    use HasFactory;

    protected $fillable = [
        'tier_name',
        'price',
        'perks_json',
    ];

    protected function casts(): array
    {
        return [
            'perks_json' => 'array',
        ];
    }
}
