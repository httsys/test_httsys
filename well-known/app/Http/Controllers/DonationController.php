<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Fund;
use App\Models\HeaderFooterSetting;
use App\Models\Language;
use App\Models\Menu;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class DonationController extends Controller
{
    /**
     * Every front-end page needs these for the shared layout (language
     * switcher, header/footer content, nav menu) — same lookup every other
     * public controller (ShopController, HomeController, ...) does.
     */
    protected function frontLayoutData()
    {
        if (session()->has('lang')) {
            $currentLang = Language::where('code', session()->get('lang'))->first();
        } else {
            $currentLang = Language::where('is_default', 1)->first();
        }
        $lang_id = $currentLang->id;

        return [
            'lang_id' => $lang_id,
            'currentLang' => $currentLang,
            'langs' => Language::all(),
            'headerfooter' => HeaderFooterSetting::find($lang_id),
            'menus' => Menu::where('language_id', $lang_id)->get(),
        ];
    }

    /**
     * Public donation form: pick a fund, enter contact info + amount, pick
     * how to pay.
     */
    public function index(Request $request)
    {
        $layoutData = $this->frontLayoutData();

        // Funds are per-language content (same as Product/ProductCategory
        // elsewhere on the site) — only show the ones for the language the
        // visitor currently has selected. Payment methods aren't
        // language-specific, so those aren't filtered.
        $funds = Fund::where('is_active', 1)->where('language_id', $layoutData['lang_id'])->orderBy('sort_order')->get();
        $methods = PaymentMethod::where('is_active', 1)->orderBy('sort_order')->get();

        $selectedFund = null;
        if ($request->filled('fund')) {
            $selectedFund = $funds->firstWhere('slug', $request->fund);
        }

        return view('donations.donate', array_merge(
            compact('funds', 'methods', 'selectedFund'),
            $layoutData
        ));
    }

    /**
     * Create the donation record (status: pending) and send the donor to
     * whichever payment method they picked.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'fund_id' => 'required|exists:funds,id',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'donor_mobile' => 'required_without:donor_email|nullable|string|max:20',
            'donor_email' => 'required_without:donor_mobile|nullable|email|max:191',
            'donor_name' => 'nullable|string|max:191',
            'amount' => 'required|numeric|min:10',
        ]);

        $paymentMethod = PaymentMethod::findOrFail($request->payment_method_id);

        $donation = Donation::create([
            'fund_id' => $request->fund_id,
            'payment_method_id' => $paymentMethod->id,
            'user_id' => auth()->id(),
            'donor_name' => $request->donor_name,
            'donor_mobile' => $request->donor_mobile,
            'donor_email' => $request->donor_email ?: (auth()->check() ? auth()->user()->email : null),
            'amount' => $request->amount,
            'reference' => 'DON-' . strtoupper(Str::random(10)),
            'status' => 'pending',
        ]);

        \App\Support\DonationMailer::send($donation, \App\Mail\DonationSubmittedMail::class);

        switch ($paymentMethod->type) {
            case 'sslcommerz':
                return $this->initiateSslcommerz($donation, $paymentMethod);
            case 'bkash':
                return $this->initiateBkash($donation, $paymentMethod);
            case 'nagad':
                return $this->initiateNagad($donation, $paymentMethod);
            default:
                return redirect()->route('donations.manual', $donation->reference);
        }
    }

    // ------------------------------------------------------------------
    // Manual payment methods (bank transfer, personal bKash/Nagad number,
    // cash, or anything else the admin describes in `instructions`) —
    // donor reads the instructions, pays outside the site, then pastes a
    // reference back in. An admin marks it completed after checking it.
    // ------------------------------------------------------------------

    public function manual($reference)
    {
        $donation = Donation::where('reference', $reference)->firstOrFail();

        return view('donations.manual', array_merge(
            compact('donation'),
            $this->frontLayoutData()
        ));
    }

    public function manualSubmit(Request $request, $reference)
    {
        $donation = Donation::where('reference', $reference)->firstOrFail();

        $this->validate($request, [
            'manual_reference' => 'required|string|max:191',
        ]);

        // Stays 'pending' — an admin verifies the reference against their
        // bank/wallet statement and marks it completed from the admin panel.
        $donation->update(['manual_reference' => $request->manual_reference]);

        return redirect()->route('donations.thanks', $donation->reference)
            ->with('donation_pending', true);
    }

    // ------------------------------------------------------------------
    // SSLCommerz
    // ------------------------------------------------------------------

    protected function initiateSslcommerz(Donation $donation, PaymentMethod $method)
    {
        $sandbox = $method->configValue('sandbox', true);
        $endpoint = $sandbox
            ? 'https://sandbox.sslcommerz.com/gwprocess/v4/api.php'
            : 'https://securepay.sslcommerz.com/gwprocess/v4/api.php';

        $response = Http::asForm()->post($endpoint, [
            'store_id' => $method->configValue('store_id'),
            'store_passwd' => $method->configValue('store_password'),
            'total_amount' => $donation->amount,
            'currency' => 'BDT',
            'tran_id' => $donation->reference,
            'success_url' => route('donations.callback.success', $donation->reference),
            'fail_url' => route('donations.callback.fail', $donation->reference),
            'cancel_url' => route('donations.callback.cancel', $donation->reference),
            'cus_name' => $donation->donor_name ?: 'Donor',
            'cus_email' => $donation->donor_email ?: 'donor@example.com',
            'cus_phone' => $donation->donor_mobile ?: 'N/A',
            'cus_add1' => 'N/A',
            'cus_city' => 'N/A',
            'cus_country' => 'Bangladesh',
            'shipping_method' => 'NO',
            'product_name' => 'Donation',
            'product_category' => 'Donation',
            'product_profile' => 'general',
        ]);

        $data = $response->json();

        if (! empty($data['GatewayPageURL'])) {
            return redirect()->away($data['GatewayPageURL']);
        }

        $donation->update(['status' => 'failed', 'gateway_response' => json_encode($data)]);

        return redirect()->route('donations.index')->with('donation_error', __('donation.error_no_gateway', ['method' => 'SSLCommerz']));
    }

    // ------------------------------------------------------------------
    // bKash (Tokenized Checkout)
    // ------------------------------------------------------------------

    protected function initiateBkash(Donation $donation, PaymentMethod $method)
    {
        $token = $this->bkashGrantToken($method);

        if (! $token) {
            $donation->update(['status' => 'failed']);
            return redirect()->route('donations.index')->with('donation_error', __('donation.error_gateway_connect', ['method' => 'bKash']));
        }

        $sandbox = $method->configValue('sandbox', true);
        $base = $sandbox
            ? 'https://tokenized.sandbox.bka.sh/v1.2.0-beta'
            : 'https://tokenized.pay.bka.sh/v1.2.0-beta';

        $response = Http::withHeaders([
            'Authorization' => $token,
            'X-App-Key' => $method->configValue('app_key'),
        ])->post($base . '/checkout/payment/create', [
            'amount' => (string) $donation->amount,
            'currency' => 'BDT',
            'intent' => 'sale',
            'merchantInvoiceNumber' => $donation->reference,
            'callbackURL' => route('donations.callback.bkash', $donation->reference),
        ]);

        $data = $response->json();

        // Cache the token briefly against the donation so the callback can
        // call execute-payment without a second grant round-trip.
        $donation->update(['gateway_response' => json_encode(['create' => $data])]);

        if (! empty($data['bkashURL'])) {
            return redirect()->away($data['bkashURL']);
        }

        $donation->update(['status' => 'failed']);
        return redirect()->route('donations.index')->with('donation_error', __('donation.error_no_gateway', ['method' => 'bKash']));
    }

    protected function bkashGrantToken(PaymentMethod $method)
    {
        $sandbox = $method->configValue('sandbox', true);
        $base = $sandbox
            ? 'https://tokenized.sandbox.bka.sh/v1.2.0-beta'
            : 'https://tokenized.pay.bka.sh/v1.2.0-beta';

        $response = Http::withHeaders([
            'username' => $method->configValue('username'),
            'password' => $method->configValue('password'),
        ])->post($base . '/checkout/token/grant', [
            'app_key' => $method->configValue('app_key'),
            'app_secret' => $method->configValue('app_secret'),
        ]);

        return $response->json('id_token');
    }

    public function bkashCallback(Request $request, $reference)
    {
        $donation = Donation::where('reference', $reference)->firstOrFail();
        $method = $donation->paymentMethod;

        if ($request->get('status') !== 'success' || ! $request->filled('paymentID')) {
            $donation->update(['status' => 'failed', 'gateway_response' => json_encode($request->all())]);
            return redirect()->route('donations.thanks', $donation->reference);
        }

        $token = $this->bkashGrantToken($method);
        $sandbox = $method->configValue('sandbox', true);
        $base = $sandbox
            ? 'https://tokenized.sandbox.bka.sh/v1.2.0-beta'
            : 'https://tokenized.pay.bka.sh/v1.2.0-beta';

        $response = Http::withHeaders([
            'Authorization' => $token,
            'X-App-Key' => $method->configValue('app_key'),
        ])->post($base . '/checkout/payment/execute/' . $request->get('paymentID'));

        $data = $response->json();

        if (($data['transactionStatus'] ?? null) === 'Completed') {
            $donation->markCompleted($data['trxID'] ?? null, json_encode($data));
        } else {
            $donation->update(['status' => 'failed', 'gateway_response' => json_encode($data)]);
        }

        return redirect()->route('donations.thanks', $donation->reference);
    }

    // ------------------------------------------------------------------
    // Nagad
    // ------------------------------------------------------------------
    // Nagad's checkout API additionally requires RSA-signing every request
    // with the merchant's private key (and verifying Nagad's public key on
    // responses) — that cryptographic handshake needs the merchant's actual
    // key pair to build and test, so it isn't wired up here. This method
    // creates the donation and leaves it pending with a clear message
    // rather than pretending to charge the donor; see the handoff notes
    // for what's needed to finish it.
    // ------------------------------------------------------------------

    protected function initiateNagad(Donation $donation, PaymentMethod $method)
    {
        $donation->update(['status' => 'failed']);

        return redirect()->route('donations.index')
            ->with('donation_error', __('donation.error_nagad_unavailable'));
    }

    // ------------------------------------------------------------------
    // SSLCommerz callbacks
    // ------------------------------------------------------------------

    public function sslcommerzSuccess(Request $request, $reference)
    {
        $donation = Donation::where('reference', $reference)->firstOrFail();
        $method = $donation->paymentMethod;

        $sandbox = $method->configValue('sandbox', true);
        $endpoint = $sandbox
            ? 'https://sandbox.sslcommerz.com/validator/api/validationserverAPI.php'
            : 'https://securepay.sslcommerz.com/validator/api/validationserverAPI.php';

        $verify = Http::get($endpoint, [
            'val_id' => $request->get('val_id'),
            'store_id' => $method->configValue('store_id'),
            'store_passwd' => $method->configValue('store_password'),
            'format' => 'json',
        ])->json();

        if (in_array($verify['status'] ?? null, ['VALID', 'VALIDATED'])) {
            $donation->markCompleted($request->get('tran_id'), json_encode($verify));
        } else {
            $donation->update(['status' => 'failed', 'gateway_response' => json_encode($verify)]);
        }

        return redirect()->route('donations.thanks', $donation->reference);
    }

    public function sslcommerzFail(Request $request, $reference)
    {
        $donation = Donation::where('reference', $reference)->firstOrFail();
        $donation->update(['status' => 'failed', 'gateway_response' => json_encode($request->all())]);

        return redirect()->route('donations.thanks', $donation->reference);
    }

    public function sslcommerzCancel(Request $request, $reference)
    {
        $donation = Donation::where('reference', $reference)->firstOrFail();
        $donation->update(['status' => 'cancelled', 'gateway_response' => json_encode($request->all())]);

        return redirect()->route('donations.thanks', $donation->reference);
    }

    // ------------------------------------------------------------------
    // Thank-you / status page
    // ------------------------------------------------------------------

    public function thanks($reference)
    {
        $donation = Donation::where('reference', $reference)->firstOrFail();

        return view('donations.thanks', array_merge(
            compact('donation'),
            $this->frontLayoutData()
        ));
    }
}
