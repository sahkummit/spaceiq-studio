<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title',
        'category',
        'slug',
        'short_description',
        'description',
        'icon',
        'og_image',
        'sort_order',
        'is_active',
    ];

    public function media()
    {
        return $this->hasMany(Media::class);
    }
}
