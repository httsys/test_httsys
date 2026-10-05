<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = ['code', 'name', 'is_active', 'sort_order'];

    protected $casts = ['is_active' => 'boolean'];

    public static function activeList()
    {
        return static::where('is_active', 1)->orderBy('sort_order')->orderBy('code')->get();
    }
}
