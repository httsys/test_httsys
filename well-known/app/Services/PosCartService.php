<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductVariantOption;
use App\Models\User;
use Illuminate\Support\Facades\Session;

/**
 * Session-based cart for the admin POS screen. Deliberately separate from
 * the storefront's CartService (different session key) so a cashier using
 * the POS never interferes with — or gets interfered with by — whatever is
 * sitting in a customer's own shopping cart in another tab/session.
 *
 * Line shape stored in session(self::SESSION_KEY)['lines']:
 *   'productId-optA-optB' => [
 *       'product_id' => 12,
 *       'option_ids' => [3, 7],
 *       'quantity'   => 1,
 *   ]
 *
 * Also carries the selected customer (users.id, or null = "Walking
 * Customer") and the currently-applied discount alongside the lines, all
 * under the same session key, so the whole sale-in-progress lives in one
 * place and Cancel simply forgets that one key.
 */
class PosCartService
{
    const SESSION_KEY = 'pos_cart';

    protected function raw()
    {
        return Session::get(self::SESSION_KEY, [
            'lines' => [],
            'customer_id' => null,
            'discount_type' => 'percentage',
            'discount_value' => 0,
        ]);
    }

    protected function save(array $cart)
    {
        Session::put(self::SESSION_KEY, $cart);
    }

    public static function lineKey($productId, array $optionIds)
    {
        sort($optionIds);
        return $productId . ($optionIds ? '-' . implode('-', $optionIds) : '');
    }

    public function add($productId, array $optionIds = [], $quantity = 1)
    {
        $cart = $this->raw();
        $key = self::lineKey($productId, $optionIds);

        if (isset($cart['lines'][$key])) {
            $cart['lines'][$key]['quantity'] += $quantity;
        } else {
            $cart['lines'][$key] = [
                'product_id' => $productId,
                'option_ids' => $optionIds,
                'quantity' => max(1, $quantity),
            ];
        }

        $this->save($cart);
    }

    public function updateQuantity($key, $quantity)
    {
        $cart = $this->raw();

        if (! isset($cart['lines'][$key])) {
            return;
        }

        if ($quantity < 1) {
            unset($cart['lines'][$key]);
        } else {
            $cart['lines'][$key]['quantity'] = $quantity;
        }

        $this->save($cart);
    }

    public function remove($key)
    {
        $cart = $this->raw();
        unset($cart['lines'][$key]);
        $this->save($cart);
    }

    /**
     * Clears the sale-in-progress entirely: line items, chosen customer,
     * and any applied discount. Used by both "Cancel" and right after a
     * successful checkout.
     */
    public function clear()
    {
        Session::forget(self::SESSION_KEY);
    }

    public function setCustomer($userId)
    {
        $cart = $this->raw();
        $cart['customer_id'] = $userId;
        $this->save($cart);
    }

    public function customer()
    {
        $cart = $this->raw();

        if (empty($cart['customer_id'])) {
            return null;
        }

        return User::find($cart['customer_id']);
    }

    public function setDiscount($type, $value)
    {
        $cart = $this->raw();
        $cart['discount_type'] = $type === 'fixed' ? 'fixed' : 'percentage';
        $cart['discount_value'] = max(0, (float) $value);
        $this->save($cart);
    }

    public function clearDiscount()
    {
        $cart = $this->raw();
        $cart['discount_type'] = 'percentage';
        $cart['discount_value'] = 0;
        $this->save($cart);
    }

    public function discountType()
    {
        return $this->raw()['discount_type'] ?? 'percentage';
    }

    public function discountValue()
    {
        return (float) ($this->raw()['discount_value'] ?? 0);
    }

    /**
     * Hydrated cart lines — same shape/convention as the storefront
     * CartService::items(), plus a per-line tax amount based on each
     * product's effective_tax_rate.
     */
    public function items()
    {
        $cart = $this->raw();
        $rawLines = $cart['lines'];

        if (empty($rawLines)) {
            return collect();
        }

        $productIds = collect($rawLines)->pluck('product_id')->unique();
        $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

        $optionIds = collect($rawLines)->pluck('option_ids')->flatten()->unique()->filter();
        $options = ProductVariantOption::with('group')->whereIn('id', $optionIds)->get()->keyBy('id');

        $lines = collect();

        foreach ($rawLines as $key => $line) {
            $product = $products->get($line['product_id']);
            if (! $product) {
                continue;
            }

            $selectedOptions = collect($line['option_ids'])
                ->map(function ($id) use ($options) {
                    return $options->get($id);
                })
                ->filter();

            $unitPrice = $product->effective_price + $selectedOptions->sum('price_modifier');
            $quantity = $line['quantity'];
            $lineSubtotal = $unitPrice * $quantity;
            $taxRate = $product->effective_tax_rate;
            $lineTax = round($lineSubtotal * ($taxRate / 100), 2);

            $lines->push((object) [
                'key' => $key,
                'product' => $product,
                'options' => $selectedOptions->values(),
                'variant_summary' => $selectedOptions->pluck('value')->implode(' | '),
                'unit_price' => $unitPrice,
                'quantity' => $quantity,
                'line_total' => $lineSubtotal,
                'tax_rate' => $taxRate,
                'line_tax' => $lineTax,
            ]);
        }

        return $lines;
    }

    public function count()
    {
        return $this->items()->sum('quantity');
    }

    public function subtotal()
    {
        return $this->items()->sum('line_total');
    }

    public function taxTotal()
    {
        return round($this->items()->sum('line_tax'), 2);
    }

    /**
     * Discount amount in currency, computed from the applied
     * type+value against the current subtotal. Never exceeds the
     * subtotal (a 120% or overly-large fixed discount just zeroes
     * the order out rather than going negative).
     */
    public function discountAmount()
    {
        $subtotal = $this->subtotal();
        $value = $this->discountValue();

        if ($value <= 0) {
            return 0.0;
        }

        $amount = $this->discountType() === 'fixed'
            ? $value
            : $subtotal * ($value / 100);

        return round(min($amount, $subtotal), 2);
    }

    public function total()
    {
        return max(0, round($this->subtotal() + $this->taxTotal() - $this->discountAmount(), 2));
    }

    public function isEmpty()
    {
        return $this->items()->isEmpty();
    }

    public function totals()
    {
        return [
            'subtotal' => $this->subtotal(),
            'tax' => $this->taxTotal(),
            'discount' => $this->discountAmount(),
            'total' => $this->total(),
        ];
    }
}
