<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdZone extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'name',
        'code',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
