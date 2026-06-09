<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'service_id',
        'message',
        'status',
        'attachments',
    ];

    protected $casts = [
        'attachments' => 'array',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
