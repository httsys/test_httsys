<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeeSetting extends Model
{
    protected $fillable = ['service_type', 'fixed_fee', 'percent_fee'];

    /**
     * Fixed fee plus a percentage of the amount, floored at 0 and capped so
     * the fee can never exceed the amount itself (a misconfigured 100%+
     * percent_fee shouldn't be able to produce a negative payout).
     */
    public static function calculate($serviceType, $amount)
    {
        $setting = static::firstOrCreate(
            ['service_type' => $serviceType],
            ['fixed_fee' => 0, 'percent_fee' => 0]
        );

        $fee = bcadd(
            $setting->fixed_fee,
            bcdiv(bcmul($amount, $setting->percent_fee, 4), 100, 4),
            2
        );

        if (bccomp($fee, $amount, 2) > 0) {
            $fee = $amount;
        }
        if (bccomp($fee, 0, 2) < 0) {
            $fee = '0.00';
        }

        $payout = bcsub($amount, $fee, 2);

        return [
            'fee' => $fee,
            'payout' => $payout,
        ];
    }
}
