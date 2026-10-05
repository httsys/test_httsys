<?php

namespace App\Http\Controllers;

use App\Models\HeaderFooterSetting;
use App\Models\Language;
use App\Models\Menu;
use App\Models\Product;
use App\Models\ProductVariantOption;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected function frontData()
    {
        $currentLang = session()->has('lang')
            ? Language::where('code', session()->get('lang'))->first()
            : Language::where('is_default', 1)->first();

        $lang_id = $currentLang->id;

        return [
            'currentLang' => $currentLang,
            'langs' => Language::all(),
            'headerfooter' => HeaderFooterSetting::find($lang_id),
            'menus' => Menu::where('language_id', $lang_id)->get(),
        ];
    }

    public function index(CartService $cart)
    {
        $items = $cart->items();
        $subtotal = $cart->subtotal();

        return view('cart.index', array_merge($this->frontData(), [
            'items' => $items,
            'subtotal' => $subtotal,
        ]));
    }

    public function add(Request $request, CartService $cart)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1',
            'option_ids' => 'nullable|array',
            'option_ids.*' => 'exists:product_variant_options,id',
        ]);

        $product = Product::findOrFail($request->product_id);
        $optionIds = array_values($request->input('option_ids', []));

        // Sanity check: every submitted option must actually belong to
        // this product, otherwise a tampered request could mix in another
        // product's price modifier.
        if ($optionIds) {
            $validCount = ProductVariantOption::whereIn('id', $optionIds)
                ->whereHas('group', function ($q) use ($product) {
                    $q->where('product_id', $product->id);
                })
                ->count();

            if ($validCount !== count($optionIds)) {
                return $this->respond($request, $cart, back()->with('cart_error', 'Invalid product options selected.'), 'Invalid product options selected.');
            }
        }

        $cart->add($product->id, $optionIds, (int) $request->input('quantity', 1));

        return $this->respond($request, $cart, back()->with('cart_success', $product->title . ' added to cart.'));
    }

    public function updateQuantity(Request $request, CartService $cart)
    {
        $request->validate([
            'key' => 'required|string',
            'quantity' => 'required|integer|min:0',
        ]);

        $cart->updateQuantity($request->key, (int) $request->quantity);

        return $this->respond($request, $cart, back());
    }

    public function remove(Request $request, CartService $cart)
    {
        $request->validate(['key' => 'required|string']);
        $cart->remove($request->key);

        return $this->respond($request, $cart, back()->with('cart_success', 'Item removed from cart.'));
    }

    /**
     * Lightweight JSON count for the header cart badge (called from the
     * layout so every page shows an up-to-date count without a full
     * page reload dependency).
     */
    public function count(CartService $cart)
    {
        return response()->json(['count' => $cart->count()]);
    }

    /**
     * Full cart contents as JSON, used to populate the slide-in cart
     * drawer (opened from the header icon or right after Add to Cart).
     */
    public function mini(CartService $cart)
    {
        return response()->json($this->cartPayload($cart));
    }

    /**
     * AJAX requests (from the drawer / add-to-cart form) get JSON back;
     * plain form posts (no-JS fallback) keep the normal redirect.
     */
    protected function respond(Request $request, CartService $cart, $redirect, $error = null)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $payload = $this->cartPayload($cart);
            if ($error) {
                $payload['error'] = $error;
            }

            return response()->json($payload);
        }

        return $redirect;
    }

    protected function cartPayload(CartService $cart)
    {
        $items = $cart->items()->map(function ($line) {
            return [
                'key' => $line->key,
                'title' => $line->product->title,
                'image' => $line->product->photo ? '/public/images/media/' . $line->product->photo->file : '/public/img/200x200.png',
                'variant' => $line->variant_summary,
                'unit_price' => number_format($line->unit_price, 2),
                'quantity' => $line->quantity,
                'line_total' => number_format($line->line_total, 2),
            ];
        })->values();

        return [
            'items' => $items,
            'count' => $cart->count(),
            'subtotal' => number_format($cart->subtotal(), 2),
        ];
    }
}
