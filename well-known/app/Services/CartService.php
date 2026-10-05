<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductVariantOption;
use Illuminate\Support\Facades\Session;

/**
 * Session-based shopping cart. Works for guests and logged-in users alike;
 * the cart only needs to survive until checkout, at which point (login
 * required) it is turned into a real Order + OrderItem rows.
 *
 * Cart line shape stored in session('cart'), keyed by a line id built from
 * product + chosen variant options (so "Air Max / White / S" and
 * "Air Max / Black / M" are separate lines):
 *
 *   'productId-optA-optB' => [
 *       'product_id' => 12,
 *       'option_ids' => [3, 7],
 *       'quantity'   => 1,
 *   ]
 */
class CartService
{
    const SESSION_KEY = 'cart';

    protected function raw()
    {
        return Session::get(self::SESSION_KEY, []);
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

        if (isset($cart[$key])) {
            $cart[$key]['quantity'] += $quantity;
        } else {
            $cart[$key] = [
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

        if (! isset($cart[$key])) {
            return;
        }

        if ($quantity < 1) {
            unset($cart[$key]);
        } else {
            $cart[$key]['quantity'] = $quantity;
        }

        $this->save($cart);
    }

    public function remove($key)
    {
        $cart = $this->raw();
        unset($cart[$key]);
        $this->save($cart);
    }

    public function clear()
    {
        Session::forget(self::SESSION_KEY);
    }

    /**
     * Hydrated cart lines with the live Product + selected option models,
     * unit price (product effective price + sum of option price
     * modifiers) and line total. Lines for products/options that no
     * longer exist are silently dropped.
     */
    public function items()
    {
        $cart = $this->raw();
        if (empty($cart)) {
            return collect();
        }

        $productIds = collect($cart)->pluck('product_id')->unique();
        $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

        $optionIds = collect($cart)->pluck('option_ids')->flatten()->unique()->filter();
        $options = ProductVariantOption::with('group')->whereIn('id', $optionIds)->get()->keyBy('id');

        $lines = collect();

        foreach ($cart as $key => $line) {
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

            $lines->push((object) [
                'key' => $key,
                'product' => $product,
                'options' => $selectedOptions->values(),
                'variant_summary' => $selectedOptions->pluck('value')->implode(' | '),
                'unit_price' => $unitPrice,
                'quantity' => $quantity,
                'line_total' => $unitPrice * $quantity,
            ]);
        }

        return $lines;
    }

    public function count()
    {
        return collect($this->raw())->sum('quantity');
    }

    public function subtotal()
    {
        return $this->items()->sum('line_total');
    }

    public function isEmpty()
    {
        return empty($this->raw());
    }
}
