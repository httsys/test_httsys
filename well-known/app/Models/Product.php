<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'language_id',
        'user_id',
        'product_category_id',
        'brand_id',
        'photo_id',
        'img_gal1',
        'img_gal2',
        'img_gal3',
        'img_gal4',
        'title',
        'slug',
        'sku',
        'short_description',
        'body',
        'video_url',
        'shipping_return_info',
        'type',
        'price',
        'sale_price',
        'tax_rate',
        'stock',
        'digital_file_id',
        'digital_link',
        'warranty_duration',
        'warranty_unit',
        'is_flash_sale',
        'is_active',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'is_flash_sale' => 'boolean',
        'is_active' => 'boolean',
        'price' => 'float',
        'sale_price' => 'float',
        'tax_rate' => 'float',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\ProductCategory', 'product_category_id');
    }

    public function brand()
    {
        return $this->belongsTo('App\Models\Brand');
    }

    public function photo()
    {
        return $this->belongsTo('App\Models\Photo', 'photo_id');
    }

    public function digitalFile()
    {
        return $this->belongsTo('App\Models\Photo', 'digital_file_id');
    }

    public function variantGroups()
    {
        return $this->hasMany(ProductVariantGroup::class)->orderBy('sort_order');
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class)->latest();
    }

    /**
     * Gallery image URLs (skips any empty slots), for convenient looping
     * in views. These are plain pasted media-library URLs, same
     * convention as Project::img_gal1-4 — not Photo model records.
     */
    public function getGalleryAttribute()
    {
        return collect([$this->img_gal1, $this->img_gal2, $this->img_gal3, $this->img_gal4])
            ->filter()
            ->values();
    }

    /**
     * The price actually charged right now (sale price if one is set and
     * lower than the regular price, otherwise the regular price).
     */
    public function getEffectivePriceAttribute()
    {
        if (! empty($this->sale_price) && $this->sale_price > 0 && $this->sale_price < $this->price) {
            return $this->sale_price;
        }

        return $this->price;
    }

    /**
     * Average review rating, rounded to 1 decimal. Uses the loaded
     * `reviews` collection when available instead of firing a new query.
     */
    public function getAverageRatingAttribute()
    {
        $avg = $this->reviews->avg('rating');

        return $avg ? round($avg, 1) : 0;
    }

    public function getReviewsCountAttribute()
    {
        return $this->reviews->count();
    }

    public function isDigital()
    {
        return $this->type === 'digital';
    }

    /**
     * The VAT/tax percentage (e.g. 10 for 10%) to charge for this product.
     * Uses the product's own override when set, otherwise falls back to
     * the site-wide rate in config('shop.tax_rate') (stored there as a
     * fraction, e.g. 0.25, so it's converted to a percentage here).
     * Currently only consumed by the admin POS — the normal storefront
     * checkout keeps using the flat site-wide rate directly.
     */
    public function getEffectiveTaxRateAttribute()
    {
        if ($this->tax_rate !== null) {
            return (float) $this->tax_rate;
        }

        return round(((float) config('shop.tax_rate', 0)) * 100, 2);
    }
}
