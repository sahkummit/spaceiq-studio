<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = [
        'service_id',
        'title',
        'alt_text',
        'file_path',
        'source',
        'file_type',
        'category',
        'sort_order',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
