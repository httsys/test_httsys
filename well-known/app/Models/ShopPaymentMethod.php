<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopPaymentMethod extends Model
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

    public function orders()
    {
        return $this->hasMany(Order::class, 'payment_method_id');
    }

    public function isManual()
    {
        return $this->type === 'manual';
    }

    public function configValue($key, $default = null)
    {
        return data_get($this->config, $key, $default);
    }
}
