<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentMethodController extends Controller
{
    /**
     * Which config keys we accept per gateway type, so arbitrary POST data
     * never ends up stored as "credentials". Manual methods store their
     * account/number details as free-form instructions instead.
     */
    protected $configFields = [
        'sslcommerz' => ['store_id', 'store_password', 'sandbox'],
        'bkash' => ['app_key', 'app_secret', 'username', 'password', 'sandbox'],
        'nagad' => ['merchant_id', 'merchant_number', 'public_key', 'private_key', 'sandbox'],
        'manual' => ['account_number', 'account_name'],
    ];

    public function index()
    {
        $methods = PaymentMethod::orderBy('sort_order')->orderBy('id', 'desc')->get();

        return view('donations.payment-methods.index', compact('methods'));
    }

    public function create()
    {
        return redirect()->route('payment-methods.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'type' => 'required|in:sslcommerz,bkash,nagad,manual',
            'instructions' => 'nullable|string',
        ]);

        PaymentMethod::create([
            'name' => $request->name,
            'slug' => $this->uniqueSlug($request->name),
            'type' => $request->type,
            'instructions' => $request->instructions,
            'config' => $this->configFromRequest($request),
            'is_active' => $request->boolean('is_active'),
            'sort_order' => $request->sort_order ?: 0,
        ]);

        return back()->with('payment_method_success', 'Payment method created successfully!');
    }

    public function edit(PaymentMethod $paymentMethod)
    {
        return view('donations.payment-methods.edit', compact('paymentMethod'));
    }

    public function update(Request $request, PaymentMethod $paymentMethod)
    {
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'type' => 'required|in:sslcommerz,bkash,nagad,manual',
            'instructions' => 'nullable|string',
        ]);

        $paymentMethod->update([
            'name' => $request->name,
            'type' => $request->type,
            'instructions' => $request->instructions,
            // Only overwrite a credential when the admin actually typed a
            // new value, so re-saving the form doesn't blank out secrets
            // that are intentionally left masked/empty on edit.
            'config' => $this->configFromRequest($request, $paymentMethod->config ?? []),
            'is_active' => $request->boolean('is_active'),
            'sort_order' => $request->sort_order ?: 0,
        ]);

        return redirect()->route('payment-methods.index')->with('payment_method_success', 'Payment method updated successfully!');
    }

    public function destroy(PaymentMethod $paymentMethod)
    {
        $paymentMethod->delete();

        return back()->with('payment_method_success', 'Payment method deleted successfully!');
    }

    protected function configFromRequest(Request $request, array $existing = [])
    {
        $fields = $this->configFields[$request->type] ?? [];
        $config = $existing;

        foreach ($fields as $field) {
            if ($field === 'sandbox') {
                $config['sandbox'] = $request->boolean('config_sandbox');
                continue;
            }

            $value = $request->input('config_' . $field);
            if ($value !== null && $value !== '') {
                $config[$field] = $value;
            }
        }

        return $config;
    }

    protected function uniqueSlug($name, $ignoreId = null)
    {
        $base = Str::slug($name) ?: 'method';
        $slug = $base;
        $i = 1;

        while (PaymentMethod::where('slug', $slug)->when($ignoreId, function ($q) use ($ignoreId) {
            $q->where('id', '!=', $ignoreId);
        })->exists()) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }
}
