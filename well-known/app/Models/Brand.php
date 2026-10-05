<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'photo_id',
    ];

    public function photo()
    {
        return $this->belongsTo('App\Models\Photo');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }
}
