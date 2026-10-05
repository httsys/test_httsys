<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::orderBy('id', 'desc')->get();

        return view('admin.coupons.index', compact('coupons'));
    }

    public function create()
    {
        return redirect()->route('coupons.index');
    }

    public function store(Request $request)
    {
        $this->validateCoupon($request);

        Coupon::create([
            'code' => strtoupper($request->code),
            'type' => $request->type,
            'value' => $request->value,
            'max_discount' => $request->max_discount ?: null,
            'min_subtotal' => $request->min_subtotal ?: null,
            'usage_limit' => $request->usage_limit ?: null,
            'expires_at' => $request->expires_at ?: null,
            'is_active' => $request->boolean('is_active'),
        ]);

        return back()->with('coupon_success', 'Coupon created successfully!');
    }

    public function edit(Coupon $coupon)
    {
        return view('admin.coupons.edit', compact('coupon'));
    }

    public function update(Request $request, Coupon $coupon)
    {
        $this->validateCoupon($request, $coupon->id);

        $coupon->update([
            'code' => strtoupper($request->code),
            'type' => $request->type,
            'value' => $request->value,
            'max_discount' => $request->max_discount ?: null,
            'min_subtotal' => $request->min_subtotal ?: null,
            'usage_limit' => $request->usage_limit ?: null,
            'expires_at' => $request->expires_at ?: null,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('coupons.index')->with('coupon_success', 'Coupon updated successfully!');
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        return back()->with('coupon_success', 'Coupon deleted successfully!');
    }

    protected function validateCoupon(Request $request, $ignoreId = null)
    {
        $this->validate($request, [
            'code' => 'required|string|max:50|unique:coupons,code' . ($ignoreId ? ',' . $ignoreId : ''),
            'type' => 'required|in:fixed,percent',
            'value' => 'required|numeric|min:0',
            'max_discount' => 'nullable|numeric|min:0',
            'min_subtotal' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:1',
            'expires_at' => 'nullable|date',
        ]);
    }
}
