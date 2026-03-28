<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageSeo extends Model
{
    use HasFactory;

    // This table has no created_at, only updated_at
    public $timestamps = false;

    protected $fillable = [
        'route_name',
        'title',
        'description',
        'og_title',
        'og_description',
        'og_image',
        'twitter_card',
        'twitter_title',
        'twitter_description',
        'json_ld',
        'llm_summary',
        'llm_keywords',
        'canonical_url',
        'robots',
        'updated_at',
    ];

    protected function casts(): array
    {
        return [
            'json_ld'    => 'array',
            'updated_at' => 'datetime',
        ];
    }
}
