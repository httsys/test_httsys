<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'name',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Every togglable homepage section. Kept here so the admin page and the
     * homepage itself always agree on the full list, even before a row
     * exists in the database yet.
     */
    public static $sections = [
        'slider' => 'Hero Slider (top banner)',
        'about' => 'About Us',
        'services' => 'Services',
        'fun_facts' => 'Fun Facts / Counters',
        'portfolio' => 'Portfolio / Projects',
        'testimonial' => 'Testimonials',
        'blog' => 'Latest Blog Posts',
    ];

    /**
     * Get every section, creating any missing rows, keyed by their key.
     */
    public static function allKeyed()
    {
        foreach (self::$sections as $key => $name) {
            self::firstOrCreate(['key' => $key], ['name' => $name, 'is_active' => true]);
        }

        return self::all()->keyBy('key');
    }
}
