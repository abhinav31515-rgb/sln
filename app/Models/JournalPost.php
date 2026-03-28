<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournalPost extends Model
{
    /** @use HasFactory<\Database\Factories\JournalPostFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'image_url',
        'content',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }
}
