<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationSetting extends Model
{
    protected $fillable = [
        'language_id',
        'is_enabled',
        'photo_id',
        'badge_text',
        'title',
        'description',
        'button_text',
        'button_link',
    ];

    public function photo()
    {
        return $this->belongsTo('App\Models\Photo', 'photo_id');
    }
}
