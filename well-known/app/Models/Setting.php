<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'language_id',
        'title',
        'keywords',
        'author',
        'contact',
        'phone',
        'price_range',
        'country',
        'address',
        'whatsapp',
        'whatsapp_order_number',
        'font',
        'favicon',
        'facebook_pixel',
        'facebook_pixel_switch',
        'analytics',
        'analytics_switch',
        'SchmeaORG',
        'SchmeaORG_switch',
        'OGgraph',
        'OGgraph_switch',
        'photo_id',
        'photo_dark_id',
        'custom_css',
        'custom_js',
        'loader_status',
        'loader_img',
        'loader_color',
        'maintenance_status',
        'maintenance_text',
        'ticker_text',
        'ticker_status',
        'email_verification_enabled',
        'slider_autoplay_seconds',
        'ip_language_detection_enabled',
        'timezone',
    ];

    public function photo(){
        return $this->belongsTo('App\Models\Photo', 'photo_id');
    }

    public function photoDark(){
        return $this->belongsTo('App\Models\Photo', 'photo_dark_id');
    }
}
