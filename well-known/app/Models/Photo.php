<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Photo extends Model
{
    protected $uploads = "/public/images/";

    protected $fillable = [
        'file',
        'share_token',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($photo) {
            if (empty($photo->share_token)) {
                // Random + unpredictable, not sequential like the id, so a
                // shared link can't be walked to reach someone else's file.
                // Str::random(40) fits exactly within the share_token
                // column's 40-char limit.
                $photo->share_token = Str::random(40);
            }
        });
    }

    /**
     * Use share_token (not the sequential id) for route model binding on
     * the public share/view link, e.g. /media/view/{share_token}.
     */
    public function getRouteKeyName()
    {
        return 'share_token';
    }
}
