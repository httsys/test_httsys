<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'type',
        'instructions',
        'config',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'config' => 'array',
    ];

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function isManual()
    {
        return $this->type === 'manual';
    }

    /**
     * Convenience accessor for a single config key, e.g.
     * $paymentMethod->configValue('store_id').
     */
    public function configValue($key, $default = null)
    {
        return data_get($this->config, $key, $default);
    }
}
